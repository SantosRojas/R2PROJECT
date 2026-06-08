<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Support\Exceptions\Halt;

class SettingsPage extends Page
{
    use InteractsWithForms;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | UnitEnum | null $navigationGroup = 'Administración';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::getAll();

        $this->form->fill([
            'site_name' => $settings['site_name'] ?? null,
            'site_description' => $settings['site_description'] ?? null,
            'logo_url' => $settings['logo_url'] ?? null,
            'favicon_url' => $settings['favicon_url'] ?? null,
            'primary_color' => $settings['primary_color'] ?? '#2563EB',
            'secondary_color' => $settings['secondary_color'] ?? '#1E40AF',
            'accent_color' => $settings['accent_color'] ?? '#F59E0B',
            'email' => $settings['email'] ?? null,
            'phone' => $settings['phone'] ?? null,
            'address' => $settings['address'] ?? null,
            'facebook_url' => $settings['facebook_url'] ?? null,
            'linkedin_url' => $settings['linkedin_url'] ?? null,
            'instagram_url' => $settings['instagram_url'] ?? null,
            'meta_title' => $settings['meta_title'] ?? null,
            'meta_description' => $settings['meta_description'] ?? null,
            'footer_copyright' => $settings['footer_copyright'] ?? null,
            'maintenance_mode' => $settings['maintenance_mode'] ?? false,
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Información del sitio')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Nombre del sitio')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('site_description')
                            ->label('Descripción del sitio')
                            ->rows(2)
                            ->maxLength(500),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('logo_url')
                                    ->label('URL del logo')
                                    ->placeholder('/storage/logo.png')
                                    ->maxLength(255),
                                TextInput::make('favicon_url')
                                    ->label('URL del favicon')
                                    ->placeholder('/storage/favicon.ico')
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('Colores corporativos')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                ColorPicker::make('primary_color')
                                    ->label('Color primario')
                                    ->required(),
                                ColorPicker::make('secondary_color')
                                    ->label('Color secundario'),
                                ColorPicker::make('accent_color')
                                    ->label('Color de acento'),
                            ]),
                    ]),

                Section::make('Información de contacto')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email de contacto')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->label('Teléfono')
                                    ->tel()
                                    ->maxLength(255),
                                TextInput::make('address')
                                    ->label('Dirección')
                                    ->columnSpanFull()
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('Redes sociales')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('SEO y configuración')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Título meta por defecto')
                                    ->maxLength(70),
                                Textarea::make('meta_description')
                                    ->label('Descripción meta por defecto')
                                    ->rows(2)
                                    ->maxLength(160),
                                TextInput::make('footer_copyright')
                                    ->label('Copyright del footer')
                                    ->placeholder('© 2026 R2PROJECT. Todos los derechos reservados.')
                                    ->columnSpanFull()
                                    ->maxLength(255),
                                Select::make('maintenance_mode')
                                    ->label('Modo mantenimiento')
                                    ->options([
                                        false => 'Desactivado',
                                        true => 'Activado',
                                    ])
                                    ->default(false),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                Setting::setValue($key, $value);
            }

            Notification::make()
                ->title('Configuración guardada exitosamente.')
                ->success()
                ->send();
        } catch (Halt $e) {
            return;
        }
    }
}
