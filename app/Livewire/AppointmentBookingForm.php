<?php

namespace App\Livewire;

use App\Models\AppointmentRequest;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use App\Rules\ValidPhoneNumber;
use App\Services\PhoneService;
use Carbon\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class AppointmentBookingForm extends Component
{
    // Form Inputs
    public ?int $branch_id = null;
    public ?int $service_id = null;
    public ?int $doctor_id = null;
    public string $patient_name = '';
    public string $phone = '';
    public string $preferred_date = '';
    public string $preferred_time = '';
    public string $notes = '';

    // Honeypot anti-spam field (hidden from real users)
    public string $honeypot = '';

    // State Management
    public bool $isSubmitted = false;
    public string $whatsappUrl = '';
    public array $submittedData = [];

    /**
     * Initialize component and support URL preselection query params.
     */
    public function mount(?int $branch = null, ?int $service = null, ?int $doctor = null): void
    {
        // Allow preselection from URL (e.g. ?branch=1&service=2)
        if ($branch && Branch::active()->where('id', $branch)->exists()) {
            $this->branch_id = $branch;
        }

        if ($service && Service::active()->where('id', $service)->exists()) {
            $this->service_id = $service;
        }

        if ($doctor && Doctor::active()->where('id', $doctor)->exists()) {
            $this->doctor_id = $doctor;
        }

        // Set default minimum date (tomorrow)
        $this->preferred_date = Carbon::tomorrow()->format('Y-m-d');
    }

    /**
     * When branch changes, reset dependent services and doctors.
     */
    public function updatedBranchId($value): void
    {
        $this->branch_id = $value ? (int) $value : null;
        $this->service_id = null;
        $this->doctor_id = null;
        $this->resetValidation(['branch_id', 'service_id', 'doctor_id']);
    }

    /**
     * When service changes, verify if the currently selected doctor provides it.
     */
    public function updatedServiceId($value): void
    {
        $this->service_id = $value ? (int) $value : null;

        if ($this->doctor_id && $this->service_id) {
            $doctorProvidesService = Doctor::where('id', $this->doctor_id)
                ->whereHas('services', fn ($q) => $q->where('services.id', $this->service_id))
                ->exists();

            if (! $doctorProvidesService) {
                $this->doctor_id = null;
            }
        }

        $this->resetValidation('service_id');
    }

    /**
     * Validation Rules.
     */
    protected function rules(): array
    {
        return [
            'patient_name' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['required', 'string', new ValidPhoneNumber()],
            'branch_id' => ['required', 'integer', 'exists:branches,id'],
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'preferred_time' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:500'],
            'honeypot' => ['nullable', 'max:0'],
        ];
    }

    /**
     * Bilingual Validation Error Messages.
     */
    protected function messages(): array
    {
        $isEn = app()->getLocale() === 'en';

        return [
            'patient_name.required' => $isEn ? 'Please enter the patient full name.' : 'يرجى إدخال اسم المريض بالكامل.',
            'patient_name.min' => $isEn ? 'The name must be at least 3 characters.' : 'يجب أن يتكون الاسم من 3 أحرف على الأقل.',
            'patient_name.max' => $isEn ? 'The name is too long.' : 'الاسم طويل جداً.',
            'phone.required' => $isEn ? 'Please enter your mobile phone number.' : 'يرجى إدخال رقم الجوال.',
            'branch_id.required' => $isEn ? 'Please select a branch first.' : 'يرجى اختيار الفرع أولاً.',
            'branch_id.exists' => $isEn ? 'The selected branch is invalid.' : 'الفرع المختار غير صالح.',
            'service_id.required' => $isEn ? 'Please select a dental service.' : 'يرجى اختيار الخدمة المطلوبة.',
            'service_id.exists' => $isEn ? 'The selected service is invalid.' : 'الخدمة المختارة غير صالحة.',
            'doctor_id.exists' => $isEn ? 'The selected doctor is invalid.' : 'الطبيب المختار غير صالح.',
            'preferred_date.required' => $isEn ? 'Please select your preferred appointment date.' : 'يرجى تحديد التاريخ المفضل للموعد.',
            'preferred_date.date' => $isEn ? 'Please enter a valid date.' : 'يرجى إدخال تاريخ صالح.',
            'preferred_date.after_or_equal' => $isEn ? 'The appointment date cannot be in the past.' : 'لا يمكن أن يكون تاريخ الموعد في الماضي.',
            'preferred_time.required' => $isEn ? 'Please select your preferred time slot.' : 'يرجى اختيار الوقت المفضل للموعد.',
            'notes.max' => $isEn ? 'Notes cannot exceed 500 characters.' : 'الملاحظات لا يجب أن تتجاوز 500 حرف.',
        ];
    }

    /**
     * Handle form submission, save to database, and prepare WhatsApp URL.
     */
    public function submit(): void
    {
        // 1. Honeypot check for bots
        if (! empty($this->honeypot)) {
            // Silently drop spam submissions
            return;
        }

        // 2. Rate limiting check (max 5 submissions per 5 minutes per IP)
        $ip = request()->ip() ?? 'unknown';
        $rateLimitKey = 'booking-form:' . $ip;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            $this->addError('rate_limit', app()->getLocale() === 'en'
                ? "Too many booking requests. Please wait {$seconds} seconds before trying again."
                : "لقد تجاوزت عدد المحاولات المسموح بها. يرجى الانتظار {$seconds} ثانية قبل المحاولة مرة أخرى.");
            return;
        }

        // 3. Validation
        $this->validate();

        // 4. Rate limiter hit
        RateLimiter::hit($rateLimitKey, 300);

        // 5. Normalize phone number
        $normalizedPhone = PhoneService::normalize($this->phone);

        // 6. Save AppointmentRequest in database with status 'new'
        $appointment = AppointmentRequest::create([
            'patient_name' => trim($this->patient_name),
            'phone' => $normalizedPhone,
            'branch_id' => $this->branch_id,
            'service_id' => $this->service_id,
            'doctor_id' => $this->doctor_id ?: null,
            'preferred_date' => $this->preferred_date,
            'preferred_time' => $this->preferred_time,
            'notes' => $this->notes ? trim($this->notes) : null,
            'status' => AppointmentRequest::STATUS_NEW,
        ]);

        // 7. Retrieve related models for messaging
        $branch = Branch::findOrFail($this->branch_id);
        $service = Service::findOrFail($this->service_id);
        $doctor = $this->doctor_id ? Doctor::find($this->doctor_id) : null;

        $locale = app()->getLocale();
        $branchName = $branch->getTranslation('name', $locale);
        $serviceName = $service->getTranslation('name', $locale);
        $doctorName = $doctor
            ? $doctor->getTranslation('name', $locale)
            : ($locale === 'en' ? 'Any Available Specialist' : 'أي طبيب متاح في هذا التخصص');

        // 8. Construct formatted WhatsApp message
        $formattedMessage = $this->buildWhatsappMessage(
            appointmentId: $appointment->id,
            patientName: $this->patient_name,
            phone: $this->phone,
            branchName: $branchName,
            serviceName: $serviceName,
            doctorName: $doctorName,
            date: $this->preferred_date,
            time: $this->preferred_time,
            notes: $this->notes,
            locale: $locale
        );

        // 9. Generate wa.me link
        $whatsappNumber = $branch->clean_whatsapp_number;
        $this->whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . rawurlencode($formattedMessage);

        // 10. Store summary for success card display
        $this->submittedData = [
            'id' => $appointment->id,
            'patient_name' => $this->patient_name,
            'phone' => $this->phone,
            'branch' => $branchName,
            'service' => $serviceName,
            'doctor' => $doctorName,
            'date' => $this->preferred_date,
            'time' => $this->preferred_time,
            'notes' => $this->notes,
            'branch_whatsapp' => $whatsappNumber,
        ];

        $this->isSubmitted = true;

        // 11. Dispatch browser event to trigger redirect / window.open
        $this->dispatch('appointment-submitted', [
            'url' => $this->whatsappUrl,
        ]);
    }

    /**
     * Build formatted message for WhatsApp.
     */
    protected function buildWhatsappMessage(
        int $appointmentId,
        string $patientName,
        string $phone,
        string $branchName,
        string $serviceName,
        string $doctorName,
        string $date,
        string $time,
        ?string $notes,
        string $locale
    ): string {
        if ($locale === 'en') {
            $msg = "*New Appointment Request - Dar Al Uloom Clinic*\n";
            $msg .= "----------------------------------------\n";
            $msg .= "• *Patient Name:* {$patientName}\n";
            $msg .= "• *Mobile Number:* {$phone}\n";
            $msg .= "• *Branch:* {$branchName}\n";
            $msg .= "• *Service:* {$serviceName}\n";
            $msg .= "• *Preferred Doctor:* {$doctorName}\n";
            $msg .= "• *Preferred Date:* {$date}\n";
            $msg .= "• *Preferred Time:* {$time}\n";
            if ($notes) {
                $msg .= "• *Notes:* {$notes}\n";
            }
            $msg .= "----------------------------------------\n";
            $msg .= "Booking Ref: #{$appointmentId}\n";
            $msg .= "Please confirm my appointment. Thank you!";
        } else {
            $msg = "*طلب حجز موعد جديد - عيادة دار العلوم لجراحات الفم والأسنان*\n";
            $msg .= "----------------------------------------\n";
            $msg .= "• *اسم المريض:* {$patientName}\n";
            $msg .= "• *رقم الجوال:* {$phone}\n";
            $msg .= "• *الفرع:* {$branchName}\n";
            $msg .= "• *الخدمة المطلوبة:* {$serviceName}\n";
            $msg .= "• *الطبيب المفضل:* {$doctorName}\n";
            $msg .= "• *التاريخ المفضل:* {$date}\n";
            $msg .= "• *الوقت المفضل:* {$time}\n";
            if ($notes) {
                $msg .= "• *ملاحظات:* {$notes}\n";
            }
            $msg .= "----------------------------------------\n";
            $msg .= "رقم الطلب في النظام: #{$appointmentId}\n";
            $msg .= "أرجو تأكيد موعدي، شكراً لكم.";
        }

        return $msg;
    }

    /**
     * Reset form to submit another request.
     */
    public function resetForm(): void
    {
        $this->reset([
            'branch_id',
            'service_id',
            'doctor_id',
            'patient_name',
            'phone',
            'notes',
            'isSubmitted',
            'whatsappUrl',
            'submittedData',
        ]);

        $this->preferred_date = Carbon::tomorrow()->format('Y-m-d');
        $this->preferred_time = '';
    }

    /**
     * Render the Livewire component.
     */
    public function render()
    {
        // 1. Available active branches
        $branches = Branch::active()->get();

        // 2. Services available at selected branch (via doctors assigned to this branch)
        $services = collect();
        if ($this->branch_id) {
            $services = Service::whereHas('doctors', function ($q) {
                $q->whereHas('branches', function ($b) {
                    $b->where('branches.id', $this->branch_id);
                });
            })->active()->ordered()->get();
        }

        // 3. Doctors available at selected branch (and filtered by service if selected)
        $doctors = collect();
        if ($this->branch_id) {
            $doctorQuery = Doctor::active()
                ->whereHas('branches', fn ($b) => $b->where('branches.id', $this->branch_id));

            if ($this->service_id) {
                $doctorQuery->whereHas('services', fn ($s) => $s->where('services.id', $this->service_id));
            }

            $doctors = $doctorQuery->get();
        }

        // 4. Time slots
        $timeSlots = [
            'morning' => [
                'label' => app()->getLocale() === 'en' ? 'Morning Period' : 'الفترة الصباحية',
                'slots' => [
                    '09:00 AM - 10:00 AM' => app()->getLocale() === 'en' ? '09:00 AM - 10:00 AM' : '09:00 ص - 10:00 ص',
                    '10:00 AM - 11:00 AM' => app()->getLocale() === 'en' ? '10:00 AM - 11:00 AM' : '10:00 ص - 11:00 ص',
                    '11:00 AM - 12:00 PM' => app()->getLocale() === 'en' ? '11:00 AM - 12:00 PM' : '11:00 ص - 12:00 م',
                    '12:00 PM - 01:00 PM' => app()->getLocale() === 'en' ? '12:00 PM - 01:00 PM' : '12:00 م - 01:00 م',
                ],
            ],
            'evening' => [
                'label' => app()->getLocale() === 'en' ? 'Evening Period' : 'الفترة المسائية',
                'slots' => [
                    '04:00 PM - 05:00 PM' => app()->getLocale() === 'en' ? '04:00 PM - 05:00 PM' : '04:00 م - 05:00 م',
                    '05:00 PM - 06:00 PM' => app()->getLocale() === 'en' ? '05:00 PM - 06:00 PM' : '05:00 م - 06:00 م',
                    '06:00 PM - 07:00 PM' => app()->getLocale() === 'en' ? '06:00 PM - 07:00 PM' : '06:00 م - 07:00 م',
                    '07:00 PM - 08:00 PM' => app()->getLocale() === 'en' ? '07:00 PM - 08:00 PM' : '07:00 م - 08:00 م',
                    '08:00 PM - 09:00 PM' => app()->getLocale() === 'en' ? '08:00 PM - 09:00 PM' : '08:00 م - 09:00 م',
                ],
            ],
        ];

        return view('livewire.appointment-booking-form', [
            'branches' => $branches,
            'services' => $services,
            'doctors' => $doctors,
            'timeSlots' => $timeSlots,
        ]);
    }
}
