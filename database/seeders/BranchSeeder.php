<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unifiedPhone = '920066788';
        $unifiedWhatsapp = '966920066788';

        // 1. فرع الرياض
        Branch::updateOrCreate(
            ['id' => 1],
            [
                'name' => [
                    'ar' => 'فرع الرياض',
                    'en' => 'Riyadh Branch',
                ],
                'address' => [
                    'ar' => 'طريق الملك فهد، حي العليا، برج دار العلوم الطبي، الرياض، المملكة العربية السعودية',
                    'en' => 'King Fahd Road, Al Olaya District, Dar Al Uloom Medical Tower, Riyadh, Saudi Arabia',
                ],
                // International format without '+' or leading zeros
                'whatsapp_number' => $unifiedWhatsapp,
                'phone' => $unifiedPhone,
                'working_hours' => [
                    'ar' => 'السبت - الخميس: 9:00 ص - 10:00 م | الجمعة: 4:00 م - 9:00 م',
                    'en' => 'Sat - Thu: 9:00 AM - 10:00 PM | Fri: 4:00 PM - 9:00 PM',
                ],
                'map_url' => 'https://maps.google.com/?q=24.7136,46.6753',
                'is_active' => true,
            ]
        );

        // 2. فرع جدة
        Branch::updateOrCreate(
            ['id' => 2],
            [
                'name' => [
                    'ar' => 'فرع جدة',
                    'en' => 'Jeddah Branch',
                ],
                'address' => [
                    'ar' => 'طريق الملك عبدالعزيز، حي الشاطئ، مركز الأعمال الطبي، جدة، المملكة العربية السعودية',
                    'en' => 'King Abdulaziz Road, Al Shati District, Medical Business Center, Jeddah, Saudi Arabia',
                ],
                // International format without '+' or leading zeros
                'whatsapp_number' => $unifiedWhatsapp,
                'phone' => $unifiedPhone,
                'working_hours' => [
                    'ar' => 'السبت - الخميس: 9:00 ص - 10:00 م | الجمعة: 4:00 م - 9:00 م',
                    'en' => 'Sat - Thu: 9:00 AM - 10:00 PM | Fri: 4:00 PM - 9:00 PM',
                ],
                'map_url' => 'https://maps.google.com/?q=21.5433,39.1728',
                'is_active' => true,
            ]
        );

        // 3. فرع الطائف
        Branch::updateOrCreate(
            ['id' => 3],
            [
                'name' => [
                    'ar' => 'فرع الطائف',
                    'en' => 'Taif Branch',
                ],
                'address' => [
                    'ar' => 'شارع شهار العام، مجمع العيادات التخصصية، الطائف، المملكة العربية السعودية',
                    'en' => 'Shehar Street, Specialized Clinics Complex, Taif, Saudi Arabia',
                ],
                // International format without '+' or leading zeros
                'whatsapp_number' => $unifiedWhatsapp,
                'phone' => $unifiedPhone,
                'working_hours' => [
                    'ar' => 'السبت - الخميس: 9:00 ص - 9:30 م | الجمعة: 4:00 م - 9:00 م',
                    'en' => 'Sat - Thu: 9:00 AM - 9:30 PM | Fri: 4:00 PM - 9:00 PM',
                ],
                'map_url' => 'https://maps.google.com/?q=21.2854,40.4222',
                'is_active' => true,
            ]
        );
    }
}
