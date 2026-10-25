<?php

namespace Tests\Feature;

use App\Livewire\AppointmentBookingForm;
use App\Models\AppointmentRequest;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use Carbon\Carbon;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AppointmentBookingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_booking_page_renders_successfully(): void
    {
        $response = $this->get('/booking');

        $response->assertStatus(200);
        $response->assertSeeLivewire(AppointmentBookingForm::class);
    }

    public function test_booking_form_validation_requires_mandatory_fields(): void
    {
        Livewire::test(AppointmentBookingForm::class)
            ->set('preferred_date', '')
            ->call('submit')
            ->assertHasErrors(['patient_name', 'phone', 'branch_id', 'service_id', 'preferred_date', 'preferred_time']);
    }

    public function test_booking_form_rejects_invalid_phone_number(): void
    {
        $branch = Branch::first();
        $service = Service::first();

        Livewire::test(AppointmentBookingForm::class)
            ->set('patient_name', 'أحمد علي')
            ->set('phone', '12345') // invalid format
            ->set('branch_id', $branch->id)
            ->set('service_id', $service->id)
            ->set('preferred_date', Carbon::tomorrow()->format('Y-m-d'))
            ->set('preferred_time', '10:00 ص - 11:00 ص')
            ->call('submit')
            ->assertHasErrors(['phone']);
    }

    public function test_booking_form_rejects_past_date(): void
    {
        $branch = Branch::first();
        $service = Service::first();

        Livewire::test(AppointmentBookingForm::class)
            ->set('patient_name', 'أحمد علي')
            ->set('phone', '771234567')
            ->set('branch_id', $branch->id)
            ->set('service_id', $service->id)
            ->set('preferred_date', Carbon::yesterday()->format('Y-m-d'))
            ->set('preferred_time', '10:00 ص - 11:00 ص')
            ->call('submit')
            ->assertHasErrors(['preferred_date']);
    }

    public function test_successful_booking_saves_to_database_and_generates_whatsapp_url(): void
    {
        $riyadh = Branch::where('name->ar', 'like', '%الرياض%')->first();
        $service = Service::first();
        $doctor = Doctor::first();

        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        Livewire::test(AppointmentBookingForm::class)
            ->set('patient_name', 'محمد قاسم القحطاني')
            ->set('phone', '0501122334')
            ->set('branch_id', $riyadh->id)
            ->set('service_id', $service->id)
            ->set('doctor_id', $doctor->id)
            ->set('preferred_date', $tomorrow)
            ->set('preferred_time', '10:00 ص - 11:00 ص')
            ->set('notes', 'استشارة أولى بخصوص تقويم الأسنان')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('isSubmitted', true)
            ->assertDispatched('appointment-submitted');

        $this->assertDatabaseHas('appointment_requests', [
            'patient_name' => 'محمد قاسم القحطاني',
            'phone' => '966501122334',
            'branch_id' => $riyadh->id,
            'service_id' => $service->id,
            'doctor_id' => $doctor->id,
            'status' => 'new',
        ]);
    }
}
