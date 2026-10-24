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
        // 1. فرع صنعاء
        Branch::updateOrCreate(
            ['id' => 1],
            [
                'name' => [
                    'ar' => 'فرع صنعاء',
                    'en' => 'Sana\'a Branch',
                ],
                'address' => [
                    'ar' => 'شارع الستين الجنوبي، تقاطع حدة، جوار برج الرويشان، صنعاء، اليمن',
                    'en' => 'South Sixty Street, Hadda Intersection, Near Al-Rowaishan Tower, Sana\'a, Yemen',
                ],
                // International format without '+' or leading zeros
                'whatsapp_number' => '967771234567',
                'phone' => '+9671445566',
                'working_hours' => [
                    'ar' => 'السبت - الخميس: 9:00 ص - 9:00 م | الجمعة: 3:00 م - 8:00 م',
                    'en' => 'Sat - Thu: 9:00 AM - 9:00 PM | Fri: 3:00 PM - 8:00 PM',
                ],
                'map_url' => 'https://maps.google.com/?q=15.3364,44.1843',
                'is_active' => true,
            ]
        );

        // 2. فرع إب
        Branch::updateOrCreate(
            ['id' => 2],
            [
                'name' => [
                    'ar' => 'فرع إب',
                    'en' => 'Ibb Branch',
                ],
                'address' => [
                    'ar' => 'شارع العدين، مجمع النخبة الطبي، بالقرب من جولة المعاين، مدينة إب، اليمن',
                    'en' => 'Al-Udayn Street, Elite Medical Complex, Near Al-Ma\'ayen Roundabout, Ibb City, Yemen',
                ],
                // International format without '+' or leading zeros
                'whatsapp_number' => '967739876543',
                'phone' => '+9674223344',
                'working_hours' => [
                    'ar' => 'السبت - الخميس: 8:30 ص - 8:30 م | الجمعة: مغلق',
                    'en' => 'Sat - Thu: 8:30 AM - 8:30 PM | Fri: Closed',
                ],
                'map_url' => 'https://maps.google.com/?q=13.9759,44.1709',
                'is_active' => true,
            ]
        );
    }
}
