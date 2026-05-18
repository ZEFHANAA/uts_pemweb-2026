<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Project;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalProjects    = Project::count();
        $completedProj    = Project::where('status', 'completed')->count();
        $inProgressProj   = Project::where('status', 'in-progress')->count();
        $newMessages      = ContactMessage::where('status', 'new')->count();
        $totalMessages    = ContactMessage::count();
        $avgProgress      = Project::avg('progress') ?? 0;

        return [
            Stat::make('Total Projects', $totalProjects)
                ->description('Semua project di portofolio')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('primary')
                ->chart([3, 4, 5, 5, 6, $totalProjects]),

            Stat::make('Selesai', $completedProj)
                ->description($inProgressProj . ' sedang berjalan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([1, 2, 2, 3, $completedProj]),

            Stat::make('Rata-rata Progress', round($avgProgress) . '%')
                ->description('Dari semua project')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning')
                ->chart([20, 40, 50, 60, 70, round($avgProgress)]),

            Stat::make('Pesan Masuk', $totalMessages)
                ->description($newMessages . ' pesan belum dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($newMessages > 0 ? 'danger' : 'success')
                ->chart([0, 1, 1, 2, $totalMessages]),
        ];
    }
}
