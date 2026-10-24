<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use Filament\Widgets\ChartWidget;

class TopServicesWidget extends ChartWidget
{
    protected ?string $heading = 'أكثر الخدمات السنية طلباً';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $services = Service::withCount('appointmentRequests')
            ->orderBy('appointment_requests_count', 'desc')
            ->limit(6)
            ->get();

        $labels = [];
        $data = [];

        foreach ($services as $service) {
            $labels[] = $service->getTranslation('name', 'ar');
            $data[] = $service->appointment_requests_count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'عدد الحجوزات',
                    'data' => $data,
                    'backgroundColor' => [
                        '#D4AF37', // Gold
                        '#3B2A1E', // Brown
                        '#F39200', // Orange
                        '#B89326', // Dark Gold
                        '#7B563B', // Light Brown
                        '#F0DDA8', // Light Gold
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
