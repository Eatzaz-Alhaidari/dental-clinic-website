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
                'branches' => [1, 2], // الرياض وجدة
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
                'branches' => [1, 2], // الرياض وجدة
                'services' => [2], // طب أسنان الأطفال
            ],
            [
                'id' => 3,
                'name' => [
                    'ar' => 'د. طارق بن فهد الدوسري',
                    'en' => 'Dr. Tariq Al-Dossary',
                ],
                'specialty' => [
                    'ar' => 'استشاري زراعة الأسنان وجراحة الفم والفكين',
                    'en' => 'Consultant in Dental Implants & Oral Surgery',
                ],
                'bio' => [
                    'ar' => 'البورد في زراعة الأسنان، أجرى أكثر من 4000 عملية زراعة ناجحة وزراعة عظام الفكين وجراحات الفم الدقيقة.',
                    'en' => 'Certified in Oral Implantology, performed over 4,000 successful dental implants and bone grafts.',
                ],
                'photo' => 'doctors/dr-tariq.jpg',
                'is_active' => true,
                'branches' => [1, 2, 3], // الرياض، جدة، الطائف
                'services' => [3, 6], // زراعة الأسنان + علاج اللثة
            ],
            [
                'id' => 4,
                'name' => [
                    'ar' => 'د. لمى بنت عبدالله الشريف',
                    'en' => 'Dr. Lama Al-Sharif',
                ],
                'specialty' => [
                    'ar' => 'استشارية تجميل الأسنان وابتسامة هوليوود',
                    'en' => 'Cosmetic Dentistry & Smile Makeover Specialist',
                ],
                'bio' => [
                    'ar' => 'متخصصة في الفينير والعدسات الرقمية، خبرة واسعة في تصميم الابتسامة الرقمية (DSD) وتبييض الأسنان بالليزر.',
                    'en' => 'Expert in ultra-thin digital veneers, Hollywood smile design, and advanced laser whitening.',
                ],
                'photo' => 'doctors/dr-lama.jpg',
                'is_active' => true,
                'branches' => [2, 3], // جدة والطائف
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
                    'en' => 'Endodontist & Microscopic Root Canal Specialist',
                ],
                'bio' => [
                    'ar' => 'متخصص في علاج قنوات الجذور المعقدة باستخدام أحدث الميكروسكوبات الجراحية العالمية في جلسة واحدة بدون ألم.',
                    'en' => 'Specialist in complex microscopic root canal treatment using state-of-the-art dental operating microscopes.',
                ],
                'photo' => 'doctors/dr-hossam.jpg',
                'is_active' => true,
                'branches' => [1, 2, 3], // الرياض، جدة، الطائف
                'services' => [5], // علاج جذور وعصب الأسنان
            ],
            [
                'id' => 6,
                'name' => [
                    'ar' => 'د. عبدالكريم بن يحيى المؤيد',
                    'en' => 'Dr. Abdulkarim Al-Moayad',
                ],
                'specialty' => [
                    'ar' => 'استشاري جراحة الوجه والفكين وزراعة الأسنان المتقدمة',
                    'en' => 'Consultant in Maxillofacial Surgery & Advanced Implantology',
                ],
                'bio' => [
                    'ar' => 'دكتوراه في جراحة الوجه والفكين، متخصص في خلع أضراس العقل المطمورة جراحياً والترميم المتقدم لعظام الفك والجيوب الأنفية.',
                    'en' => 'Ph.D. in Oral & Maxillofacial Surgery, expert in impacted teeth removal and complex sinus lifts.',
                ],
                'photo' => 'doctors/dr-abdulkarim.jpg',
                'is_active' => true,
                'branches' => [1, 3], // الرياض والطائف
                'services' => [3, 6], // زراعة الأسنان + علاج اللثة
            ],
            [
                'id' => 7,
                'name' => [
                    'ar' => 'د. ريم بنت نبيل العولقي',
                    'en' => 'Dr. Reem Al-Awlaqi',
                ],
                'specialty' => [
                    'ar' => 'أخصائية طب أسنان الأطفال وذوي الاحتياجات الخاصة',
                    'en' => 'Specialist in Pediatric Dentistry & Special Care Patients',
                ],
                'bio' => [
                    'ar' => 'خبرة واسعة في التخدير الآمن وعلاج أسنان الأطفال الحساسة والحالات الخائفة وتقديم رعاية سنية وقائية متكاملة.',
                    'en' => 'Expert in conscious sedation, behavioral management, and preventive treatments for children.',
                ],
                'photo' => 'doctors/dr-reem.jpg',
                'is_active' => true,
                'branches' => [2, 3], // جدة والطائف
                'services' => [2], // طب أسنان الأطفال
            ],
            [
                'id' => 8,
                'name' => [
                    'ar' => 'د. وليد بن أحمد الصنعاني',
                    'en' => 'Dr. Waleed Al-Sanani',
                ],
                'specialty' => [
                    'ar' => 'أخصائي تقويم الأسنان والتقويم الشفاف',
                    'en' => 'Specialist in Orthodontics & Clear Aligners',
                ],
                'bio' => [
                    'ar' => 'معتمد في تقويم الأسنان الشفاف (Invisalign) وتقويم الفكين الوظيفي للمراهقين والبالغين مع خطط رقمية ثلاثية الأبعاد.',
                    'en' => 'Certified Invisalign provider, specialized in digital 3D orthodontic biomechanics and smile aesthetics.',
                ],
                'photo' => 'doctors/dr-waleed.jpg',
                'is_active' => true,
                'branches' => [1, 3], // الرياض والطائف
                'services' => [1], // تقويم الأسنان
            ],
            [
                'id' => 9,
                'name' => [
                    'ar' => 'د. أروى بنت عبدالملك الحكيمي',
                    'en' => 'Dr. Arwa Al-Hakimi',
                ],
                'specialty' => [
                    'ar' => 'أخصائية تجميل الأسنان وتركيبات الزيركون والإيماكس',
                    'en' => 'Specialist in Esthetic Dentistry & Zirconia/E-max Restorations',
                ],
                'bio' => [
                    'ar' => 'ماجستير الاستعاضة السنية التجميلية، متخصصة في العدسات اللاصقة التجميلية والجسور الخزفية بأعلى دقة مطابقة للأسنان الطبيعية.',
                    'en' => 'Master’s in Esthetic Restorative Dentistry, focused on ultra-natural laminates and ceramic crowns.',
                ],
                'photo' => 'doctors/dr-arwa.jpg',
                'is_active' => true,
                'branches' => [1, 2], // الرياض وجدة
                'services' => [4, 6], // تجميل الأسنان + تنظيف الأسنان
            ],
            [
                'id' => 10,
                'name' => [
                    'ar' => 'د. ماجد بن علي الغابري',
                    'en' => 'Dr. Majed Al-Ghabri',
                ],
                'specialty' => [
                    'ar' => 'استشاري علاج جذور وعصب الأسنان المعقدة بالمجهر',
                    'en' => 'Consultant in Micro-Endodontics & Dental Trauma',
                ],
                'bio' => [
                    'ar' => 'البورد العربي في علاج جذور الأسنان، خبير في إعادة علاج القنوات الفاشلة جراحياً واستخراج الأدوات المكسورة بدقة متناهية.',
                    'en' => 'Arab Board in Endodontics, expert in endodontic microsurgery and retreatments.',
                ],
                'photo' => 'doctors/dr-majed.jpg',
                'is_active' => true,
                'branches' => [1, 2], // الرياض وجدة
                'services' => [5], // علاج جذور الأسنان
            ],
            [
                'id' => 11,
                'name' => [
                    'ar' => 'د. نادية بنت مصطفى باحاج',
                    'en' => 'Dr. Nadia Bahaj',
                ],
                'specialty' => [
                    'ar' => 'أخصائية علاج اللثة وزراعة الأسنان التجميلية',
                    'en' => 'Periodontist & Aesthetic Implantology Specialist',
                ],
                'bio' => [
                    'ar' => 'ماجستير في جراحة وعلاج اللثة وأنسجة الفم، متخصصة في علاج تراجع اللثة وتوريد اللثة بالليزر وزراعة الأسنان التجميلية.',
                    'en' => 'Master’s in Periodontology, specializing in gum disease therapy, laser gum bleaching, and aesthetic implants.',
                ],
                'photo' => 'doctors/dr-nadia.jpg',
                'is_active' => true,
                'branches' => [2, 3], // جدة والطائف
                'services' => [3, 6], // زراعة الأسنان + علاج اللثة
            ],
            [
                'id' => 12,
                'name' => [
                    'ar' => 'د. فيصل بن عبدالله اليافعي',
                    'en' => 'Dr. Faisal Al-Yafie',
                ],
                'specialty' => [
                    'ar' => 'أخصائي جراحة الفم والزراعة الفورية والتعويضات',
                    'en' => 'Specialist in Oral Surgery & Immediate Dental Implants',
                ],
                'bio' => [
                    'ar' => 'متخصص في تقنيات الزراعة الفورية في نفس يوم الخلع، واستعادة الأسنان المفقودة بتقنيات All-on-4 و All-on-6 الحديثة.',
                    'en' => 'Expert in immediate loading implants, same-day fixed teeth, and full arch restorations (All-on-4/6).',
                ],
                'photo' => 'doctors/dr-faisal.jpg',
                'is_active' => true,
                'branches' => [2, 3], // جدة والطائف
                'services' => [3, 5], // زراعة الأسنان + علاج الجذور
            ],
            [
                'id' => 13,
                'name' => [
                    'ar' => 'د. هدى بنت سعيد الإرياني',
                    'en' => 'Dr. Huda Al-Eryani',
                ],
                'specialty' => [
                    'ar' => 'أخصائية طب أسنان الأطفال والأسنان الوقائي',
                    'en' => 'Specialist in Pediatric & Preventive Dentistry',
                ],
                'bio' => [
                    'ar' => 'متخصصة في العناية بأسنان الرضع والأطفال، وتطبيق الحشوات الوقائية وعلاج التسوس المبكر وتعديل سلوك الطفل داخل العيادة.',
                    'en' => 'Focused on early infant oral health, preventive pit & fissure sealants, and gentle dental habit correction.',
                ],
                'photo' => 'doctors/dr-huda.jpg',
                'is_active' => true,
                'branches' => [1, 3], // الرياض والطائف
                'services' => [2], // طب أسنان الأطفال
            ],
            [
                'id' => 14,
                'name' => [
                    'ar' => 'د. هيثم بن ناصر باوزير',
                    'en' => 'Dr. Haitham Bawazir',
                ],
                'specialty' => [
                    'ar' => 'استشاري الاستعاضة السنية والتركيبات الثابتة والزيركون',
                    'en' => 'Consultant in Fixed Prosthodontics & Full Mouth Rehabilitation',
                ],
                'bio' => [
                    'ar' => 'زمالة الكلية الملكية في الاستعاضة السنية، خبير في إعادة التأهيل الشامل للفم وتيجان الإيماكس والزيركون الرقمية عالية المتانة.',
                    'en' => 'Royal College Fellow in Prosthodontics, expert in full-mouth occlusal rehabilitation and digital CAD/CAM restorations.',
                ],
                'photo' => 'doctors/dr-haitham.jpg',
                'is_active' => true,
                'branches' => [1, 2], // الرياض وجدة
                'services' => [3, 4], // زراعة وتعويضات + تجميل الأسنان
            ],
            [
                'id' => 15,
                'name' => [
                    'ar' => 'د. دينا بنت إبراهيم شرف الدين',
                    'en' => 'Dr. Dina Sharafaddin',
                ],
                'specialty' => [
                    'ar' => 'أخصائية تقويم الأسنان والفكين والتقويم الوظيفي',
                    'en' => 'Specialist in Orthodontics & Functional Jaw Orthopedics',
                ],
                'bio' => [
                    'ar' => 'متخصصة في تقويم الأسنان الوظيفي والوقائي للأطفال والمراهقين، وتصحيح العضات المعكوسة وتقويم الأسنان الرقمي ثلاثي الأبعاد.',
                    'en' => 'Specialist in interceptive functional orthodontics for children and teenagers, as well as 3D digital aligners for adults.',
                ],
                'photo' => 'doctors/dr-dina.jpg',
                'is_active' => true,
                'branches' => [1, 2, 3], // الرياض، جدة، الطائف
                'services' => [1], // تقويم الأسنان وتعديل الفكين
            ],
        ];

        foreach ($doctorsData as $data) {
            $branches = $data['branches'];
            $services = $data['services'];
            unset($data['branches'], $data['services']);

            $doctor = Doctor::updateOrCreate(['id' => $data['id']], $data);

            // Sync branches and services
            $doctor->branches()->sync($branches);
            $doctor->services()->sync($services);
        }
    }
}
