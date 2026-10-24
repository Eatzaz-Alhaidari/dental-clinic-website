<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Branch>
 */
class BranchFactory extends Factory
{
    protected $model = Branch::class;

    public function definition(): array
    {
        return [
            'name' => [
                'ar' => 'فرع ' . fake('ar_SA')->city(),
                'en' => fake('en_US')->city() . ' Branch',
            ],
            'address' => [
                'ar' => fake('ar_SA')->address(),
                'en' => fake('en_US')->address(),
            ],
            'whatsapp_number' => '967' . fake()->numerify('7#######'),
            'phone' => '+9671' . fake()->numerify('######'),
            'working_hours' => [
                'ar' => 'السبت - الخميس: 9:00 ص - 10:00 م',
                'en' => 'Sat - Thu: 9:00 AM - 10:00 PM',
            ],
            'map_url' => 'https://maps.google.com/?q=24.7136,46.6753',
            'is_active' => true,
        ];
    }
}
