<?php

namespace App\Filament\Widgets;

use App\Models\Branch;
use Filament\Widgets\ChartWidget;

class AppointmentsByBranchWidget extends ChartWidget
{
    protected ?string $heading = 'توزيع الطلبات حسب الفروع';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $branches = Branch::withCount('appointmentRequests')->get();

        $labels = [];
        $data = [];
        $colors = ['#D4AF37', '#3B2A1E', '#F39200', '#F0DDA8'];

        foreach ($branches as $branch) {
            $labels[] = $branch->getTranslation('name', 'ar');
            $data[] = $branch->appointment_requests_count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'عدد طلبات المواعيد',
                    'data' => $data,
                    'backgroundColor' => array_slice($colors, 0, count($data)),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    public static function canView(): bool
    {
        $user = auth()->user();
        return ! $user || $user->isSuperAdmin();
    }
}
