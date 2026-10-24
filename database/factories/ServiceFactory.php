<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => [
                'ar' => 'خدمة علاج ' . fake('ar_SA')->word(),
                'en' => fake('en_US')->words(2, true) . ' Service',
            ],
            'description' => [
                'ar' => fake('ar_SA')->paragraph(),
                'en' => fake('en_US')->paragraph(),
            ],
            'icon' => 'heroicon-o-sparkles',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
