<?php

namespace App\Filament\Widgets;

use App\Models\AppointmentRequest;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = auth()->user();
        $query = AppointmentRequest::query();

        // Scope to receptionist's branch if applicable
        if ($user && $user->isReceptionist() && $user->branch_id) {
            $query->where('branch_id', $user->branch_id);
            $branchName = $user->branch ? ' (' . $user->branch->getTranslation('name', 'ar') . ')' : '';
        } else {
            $branchName = ' (كافة الفروع)';
        }

        $todayCount = (clone $query)->whereDate('created_at', Carbon::today())->count();
        $newCount = (clone $query)->where('status', AppointmentRequest::STATUS_NEW)->count();
        $confirmedCount = (clone $query)->where('status', AppointmentRequest::STATUS_CONFIRMED)->count();
        $totalCount = (clone $query)->count();

        return [
            Stat::make('طلبات اليوم' . $branchName, $todayCount)
                ->description('الطلبات المسجلة خلال اليوم')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary')
                ->chart([3, 5, 2, 8, 4, $todayCount]),

            Stat::make('طلبات جديدة بانتظار التواصل', $newCount)
                ->description('تحتاج لمتابعة فريق الاستقبال')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('warning'),

            Stat::make('المواعيد المؤكدة', $confirmedCount)
                ->description('تم تأكيد حجز الموعد بنجاح')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('إجمالي الحجوزات', $totalCount)
                ->description('كافة الطلبات المسجلة بالنظام')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info'),
        ];
    }
}
