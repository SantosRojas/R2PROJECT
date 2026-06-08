<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\Project;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Proyectos', Project::count())
                ->description('Total de proyectos')
                ->icon('heroicon-o-folder')
                ->color('primary'),
            Stat::make('Testimonios', Testimonial::count())
                ->description('Total de testimonios')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->color('success'),
            Stat::make('Contactos nuevos', Contact::unread()->count())
                ->description('Sin leer')
                ->icon('heroicon-o-envelope')
                ->color('warning'),
            Stat::make('Proyectos activos', Project::where('is_active', true)->count())
                ->description('Publicados')
                ->icon('heroicon-o-eye')
                ->color('info'),
        ];
    }
}
