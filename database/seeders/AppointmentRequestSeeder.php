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
                'patient_name' => 'عبدالرحمن بن محمد الآنسي',
                'phone' => '771122334',
                'branch_id' => 1, // Sana'a
                'service_id' => 1, // Orthodontics
                'doctor_id' => 1, // Dr. Omar
                'preferred_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'preferred_time' => '05:00 م',
                'notes' => 'أرغب باستشارة لتقويم شفاف إنفيزلاين وتعديل إطباق الفك.',
                'status' => AppointmentRequest::STATUS_NEW,
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'patient_name' => 'فاطمة بنت أحمد المتوكل',
                'phone' => '732233445',
                'branch_id' => 1, // Sana'a
                'service_id' => 2, // Pediatric
                'doctor_id' => 2, // Dr. Sarah
                'preferred_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'preferred_time' => '04:30 م',
                'notes' => 'فحص أسنان لطفلي عمره 5 سنوات وعلاج تسوس سني.',
                'status' => AppointmentRequest::STATUS_CONTACTED,
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'patient_name' => 'صلاح بن عبدالملك الصبري',
                'phone' => '713344556',
                'branch_id' => 2, // Ibb
                'service_id' => 3, // Implants
                'doctor_id' => 3, // Dr. Tariq
                'preferred_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'preferred_time' => '06:00 م',
                'notes' => 'استشارة زراعة ضرس علوي مفقود مع فحص الأشعة.',
                'status' => AppointmentRequest::STATUS_CONFIRMED,
                'created_at' => Carbon::now()->subDay(),
            ],
            [
                'patient_name' => 'أروى بنت عبدالرحمن الحبيشي',
                'phone' => '774455667',
                'branch_id' => 2, // Ibb
                'service_id' => 4, // Hollywood Smile
                'doctor_id' => 4, // Dr. Lama
                'preferred_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'preferred_time' => '07:30 م',
                'notes' => 'أرغب بابتسامة هوليوود وعدسات فينير لـ 16 سناً.',
                'status' => AppointmentRequest::STATUS_NEW,
                'created_at' => Carbon::now()->subMinutes(30),
            ],
            [
                'patient_name' => 'حمزة بن علي الشامي',
                'phone' => '785566778',
                'branch_id' => 1, // Sana'a
                'service_id' => 5, // Endodontics
                'doctor_id' => 5, // Dr. Hossam
                'preferred_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'preferred_time' => '08:00 م',
                'notes' => 'ألم حاد في الضرس السفلي يحتاج علاج عصب بالمجهر.',
                'status' => AppointmentRequest::STATUS_CONFIRMED,
                'created_at' => Carbon::now()->subHours(10),
            ],
            [
                'patient_name' => 'أصيل بن ناصر اليافعي',
                'phone' => '736677889',
                'branch_id' => 2, // Ibb
                'service_id' => 6, // Hygiene
                'doctor_id' => 4, // Dr. Lama
                'preferred_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'preferred_time' => '05:30 م',
                'notes' => 'جلسة تنظيف أسنان بالموجات الصوتية وتلميع وإزالة التصبغات.',
                'status' => AppointmentRequest::STATUS_CANCELLED,
                'created_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($requests as $data) {
            AppointmentRequest::create($data);
        }
    }
}
