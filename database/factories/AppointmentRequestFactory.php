<?php

namespace Database\Factories;

use App\Models\AppointmentRequest;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AppointmentRequest>
 */
class AppointmentRequestFactory extends Factory
{
    protected $model = AppointmentRequest::class;

    public function definition(): array
    {
        return [
            'patient_name' => fake('ar_SA')->name(),
            'phone' => '05' . fake()->numerify('########'),
            'branch_id' => Branch::factory(),
            'service_id' => Service::factory(),
            'doctor_id' => Doctor::factory(),
            'preferred_date' => fake()->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
            'preferred_time' => fake()->randomElement(['10:00 ص', '12:00 م', '04:00 م', '06:00 م', '08:00 م']),
            'notes' => fake('ar_SA')->sentence(),
            'status' => fake()->randomElement(['new', 'contacted', 'confirmed', 'cancelled']),
        ];
    }
}
