<?php

namespace Database\Seeders;

use App\Models\AppointmentRequest;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requests = [
            [
                'patient_name' => 'عبدالرحمن بن محمد القحطاني',
                'phone' => '0501122334',
                'branch_id' => 1, // Riyadh
                'service_id' => 1, // Orthodontics
                'doctor_id' => 1, // Dr. Omar
                'preferred_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'preferred_time' => '05:00 م',
                'notes' => 'أرغب باستشارة لتقويم شفاف إنفيزلاين وتعديل إطباق الفك.',
                'status' => AppointmentRequest::STATUS_NEW,
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'patient_name' => 'فاطمة بنت أحمد الغامدي',
                'phone' => '0552233445',
                'branch_id' => 2, // Jeddah
                'service_id' => 2, // Pediatric
                'doctor_id' => 2, // Dr. Sarah
                'preferred_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'preferred_time' => '04:30 م',
                'notes' => 'فحص أسنان لطفلي عمره 5 سنوات وعلاج تسوس سني.',
                'status' => AppointmentRequest::STATUS_CONTACTED,
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'patient_name' => 'صلاح بن عبدالملك العتيبي',
                'phone' => '0563344556',
                'branch_id' => 3, // Taif
                'service_id' => 3, // Implants
                'doctor_id' => 3, // Dr. Tariq
                'preferred_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'preferred_time' => '06:00 م',
                'notes' => 'استشارة زراعة ضرس علوي مفقود مع فحص الأشعة.',
                'status' => AppointmentRequest::STATUS_CONFIRMED,
                'created_at' => Carbon::now()->subDay(),
            ],
            [
                'patient_name' => 'أروى بنت عبدالرحمن الشهري',
                'phone' => '0544556677',
                'branch_id' => 2, // Jeddah
                'service_id' => 4, // Hollywood Smile
                'doctor_id' => 4, // Dr. Lama
                'preferred_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'preferred_time' => '07:30 م',
                'notes' => 'تصميم ابتسامة هوليوود كاملة مع عدسات إيماكس.',
                'status' => AppointmentRequest::STATUS_NEW,
                'created_at' => Carbon::now()->subHours(8),
            ],
            [
                'patient_name' => 'مازن بن فهد الدوسري',
                'phone' => '0505566778',
                'branch_id' => 1, // Riyadh
                'service_id' => 5, // Root Canal
                'doctor_id' => 5, // Dr. Hossam
                'preferred_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'preferred_time' => '08:00 م',
                'notes' => 'ألم شديد في الضرس يحتاج فحص وسحب عصب مجهري.',
                'status' => AppointmentRequest::STATUS_CONTACTED,
                'created_at' => Carbon::now()->subHours(12),
            ],
            [
                'patient_name' => 'سارة بنت عبدالله القرني',
                'phone' => '0536677889',
                'branch_id' => 3, // Taif
                'service_id' => 6, // Gum & Cleaning
                'doctor_id' => 11, // Dr. Nadia
                'preferred_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'preferred_time' => '05:30 م',
                'notes' => 'جلسة تنظيف لثة وجير وإزالة التصبغات السطحية.',
                'status' => AppointmentRequest::STATUS_NEW,
                'created_at' => Carbon::now()->subMinutes(45),
            ],
        ];

        foreach ($requests as $data) {
            AppointmentRequest::create($data);
        }
    }
}
