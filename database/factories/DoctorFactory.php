<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            'name' => [
                'ar' => 'د. ' . fake('ar_SA')->name(),
                'en' => 'Dr. ' . fake('en_US')->name(),
            ],
            'specialty' => [
                'ar' => 'أخصائي طب وجراحة الأسنان',
                'en' => 'Dental Specialist',
            ],
            'bio' => [
                'ar' => 'خبرة أكثر من 10 سنوات في العلاجات السنية المتقدمة وتجميل الأسنان.',
                'en' => 'Over 10 years of experience in advanced dental treatments and smile design.',
            ],
            'photo' => null,
            'is_active' => true,
        ];
    }
}
