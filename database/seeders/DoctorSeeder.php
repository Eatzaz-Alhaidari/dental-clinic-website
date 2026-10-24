<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorsData = [
            [
                'id' => 1,
                'name' => [
                    'ar' => 'د. عمر بن عبدالعزيز الزهراني',
                    'en' => 'Dr. Omar Al-Zahrani',
                ],
                'specialty' => [
                    'ar' => 'استشاري تقويم وتعديل الأسنان والفكين',
                    'en' => 'Consultant in Orthodontics & Dentofacial Orthopedics',
                ],
                'bio' => [
                    'ar' => 'حاصل على الزمالة الدولية في تقويم الأسنان، خبرة أكثر من 14 عاماً في علاج الحالات المعقدة وتصميم الابتسامة بالتقويم الشفاف.',
                    'en' => 'Fellow in Orthodontics, 14+ years specializing in complex orthodontic cases and clear aligner therapy.',
                ],
                'photo' => 'doctors/dr-omar.jpg',
                'is_active' => true,
                'branches' => [1, 2], // يعمل في كلا الفرعين (صنعاء وإب)
                'services' => [1],    // تقويم الأسنان
            ],
            [
                'id' => 2,
                'name' => [
                    'ar' => 'د. سارة بنت خالد المنصور',
                    'en' => 'Dr. Sarah Al-Mansour',
                ],
                'specialty' => [
                    'ar' => 'أخصائية أولى في طب أسنان الأطفال',
                    'en' => 'Senior Specialist in Pediatric Dentistry',
                ],
                'bio' => [
                    'ar' => 'ماجستير طب أسنان الأطفال، خبيرة متميزة في التعامل مع الأطفال وتوفير جلسات علاجية هادئة وخالية من الألم.',
                    'en' => 'Master’s in Pediatric Dentistry, certified in child-centered pain-free dental rehabilitation.',
                ],
                'photo' => 'doctors/dr-sarah.jpg',
                'is_active' => true,
                'branches' => [1], // فرع صنعاء
                'services' => [2], // طب أسنان الأطفال
            ],
            [
                'id' => 3,
                'name' => [
                    'ar' => 'د. طارق بن فهد الدوسري',
                    'en' => 'Dr. Tariq Al-Dossary',
                ],
                'specialty' => [
                    'ar' => 'استشاري زراعة الأسنان وجراحة الفم',
                    'en' => 'Consultant in Dental Implants & Oral Surgery',
                ],
                'bio' => [
                    'ar' => 'البورد في زراعة الأسنان، أجرى أكثر من 4000 عملية زراعة ناجحة وزراعة عظام الفكين.',
                    'en' => 'Certified in Oral Implantology, performed over 4,000 successful dental implants and bone grafts.',
                ],
                'photo' => 'doctors/dr-tariq.jpg',
                'is_active' => true,
                'branches' => [1, 2], // كلا الفرعين (صنعاء وإب)
                'services' => [3, 6], // زراعة الأسنان + جراحة اللثة وتنظيف الأسنان
            ],
            [
                'id' => 4,
                'name' => [
                    'ar' => 'د. لمى بنت عبدالله الشريف',
                    'en' => 'Dr. Lama Al-Sharif',
                ],
                'specialty' => [
                    'ar' => 'أخصائية تجميل الأسنان وابتسامة هوليوود',
                    'en' => 'Cosmetic Dentistry & Smile Makeover Specialist',
                ],
                'bio' => [
                    'ar' => 'متخصصة في الفينير والعدسات الرقمية، خبرة واسعة في تصميم الابتسامة الرقمية (DSD).',
                    'en' => 'Expert in ultra-thin digital veneers and Hollywood smile design.',
                ],
                'photo' => 'doctors/dr-lama.jpg',
                'is_active' => true,
                'branches' => [2], // فرع إب
                'services' => [4, 6], // تجميل الأسنان + تنظيف الأسنان
            ],
            [
                'id' => 5,
                'name' => [
                    'ar' => 'د. حسام بن محمد الشهري',
                    'en' => 'Dr. Hossam Al-Shehri',
                ],
                'specialty' => [
                    'ar' => 'أخصائي علاج جذور وعصب الأسنان بالمجهر',
                    'en' => 'Specialist in Microscopic Endodontics',
                ],
                'bio' => [
                    'ar' => 'متخصص في علاج جذور الأسنان، رائد في استخدام المجهر الجراحي لعلاج قنوات الجذور الصعبة وإنقاذ الأسنان الطبيعية.',
                    'en' => 'Pioneer in microscopic surgical techniques for intricate root canal anatomy.',
                ],
                'photo' => 'doctors/dr-hossam.jpg',
                'is_active' => true,
                'branches' => [1, 2], // كلا الفرعين (صنعاء وإب)
                'services' => [5], // علاج الجذور والعصب
            ],
        ];

        foreach ($doctorsData as $data) {
            $branches = $data['branches'];
            $services = $data['services'];
            unset($data['branches'], $data['services']);

            $doctor = Doctor::updateOrCreate(['id' => $data['id']], $data);
            $doctor->branches()->sync($branches);
            $doctor->services()->sync($services);
        }
    }
}
