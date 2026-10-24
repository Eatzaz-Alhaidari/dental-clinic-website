<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'id' => 1,
                'name' => [
                    'ar' => 'تقويم الأسنان وتعديل الفكين',
                    'en' => 'Orthodontics & Dentofacial Orthopedics',
                ],
                'description' => [
                    'ar' => 'علاجات تقويم الأسنان المتقدمة باستخدام التقويم الشفاف غير المرئي (Invisalign) والتقويم الخزفي والمعدني لتصحيح وتنسيق إطباق الأسنان لابتسامة مثالية تدوم.',
                    'en' => 'Advanced orthodontic treatments including Invisalign clear aligners, ceramic, and traditional braces to align teeth and perfect your bite.',
                ],
                'icon' => 'sparkles',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => [
                    'ar' => 'طب أسنان الأطفال',
                    'en' => 'Pediatric Dentistry',
                ],
                'description' => [
                    'ar' => 'بيئة ودودة ومجهزة بأحدث التقنيات لرعاية أسنان أطفالك بدون ألم أو خوف، تشمل الوقاية من التسوس، تطبيق الفلورايد، وحشوات الأسنان اللبنية وعلاج العصب السني للأطفال.',
                    'en' => 'Gentle and specialized pediatric dental care in a child-friendly environment, covering cavity prevention, fluoride treatments, and gentle restorative care.',
                ],
                'icon' => 'face-smile',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => [
                    'ar' => 'زراعة الأسنان والتعويضات',
                    'en' => 'Dental Implants & Prosthetics',
                ],
                'description' => [
                    'ar' => 'استعادة الأسنان المفقودة بأحدث أنظمة زراعة الأسنان التيتانيوم والسويسرية، مع تركيبات وتيجان الزيركون والإيماكس لنتائج طبيعية وقوية جداً.',
                    'en' => 'Replace missing teeth with premium titanium implants, zirconia crowns, and natural-looking prosthetics built for lifetime durability.',
                ],
                'icon' => 'shield-check',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => [
                    'ar' => 'ابتسامة هوليوود وتجميل الأسنان',
                    'en' => 'Hollywood Smile & Cosmetic Dentistry',
                ],
                'description' => [
                    'ar' => 'تصميم ابتسامة رقمي (DSD)، عدسات الأسنان (فينير ولومينير فائقة الدقة)، وتبييض الأسنان بالليزر وجلسات إزالة التصبغات للحصول على إشراقة ساحرة.',
                    'en' => 'Digital Smile Design, ultra-thin porcelain veneers, Lumineers, and professional in-office laser teeth whitening for a radiant smile.',
                ],
                'icon' => 'heart',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => [
                    'ar' => 'علاج جذور وعصب الأسنان بالمجهر',
                    'en' => 'Microscopic Endodontics (Root Canal)',
                ],
                'description' => [
                    'ar' => 'علاج وحشو عصب الأسنان بدقة متناهية تحت المجهر الجراحي في جلسة واحدة دون ألم، لإنقاذ الضروس والأسنان الطبيعية من الخلع.',
                    'en' => 'Painless, single-session root canal therapy performed under surgical operating microscopes to save your natural teeth.',
                ],
                'icon' => 'bolt',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'id' => 6,
                'name' => [
                    'ar' => 'علاج اللثة وتنظيف وتلميع الأسنان',
                    'en' => 'Periodontics & Dental Hygiene',
                ],
                'description' => [
                    'ar' => 'إزالة الجير والتكلسات العميقة بتقنية الموجات فوق الصوتية، وعلاج التهابات وتراجع اللثة وتجميل خط الابتسامة بالليزر.',
                    'en' => 'Ultrasonic scaling, deep plaque removal, advanced gum therapy, and laser gum contouring for optimal oral hygiene.',
                ],
                'icon' => 'check-badge',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['id' => $service['id']], $service);
        }
    }
}
