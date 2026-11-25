<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Lead::count();
        $baru = Lead::where('status', 'baru')->count();
        $deal = Lead::where('status', 'deal')->count();
        $mingguIni = Lead::where('created_at', '>=', now()->subDays(7))->count();

        return [
            Stat::make('Total Leads', (string) $total)
                ->description('Seluruh konsultasi masuk')
                ->color('primary'),
            Stat::make('Leads Baru', (string) $baru)
                ->description('Menunggu tindak lanjut')
                ->color('info'),
            Stat::make('Leads Deal', (string) $deal)
                ->description('Proyek terkonfirmasi')
                ->color('success'),
            Stat::make('7 Hari Terakhir', (string) $mingguIni)
                ->description('Masuk dalam seminggu ini')
                ->color('warning'),
        ];
    }
}