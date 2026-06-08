<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-envelope';

    protected static string | UnitEnum | null $navigationGroup = 'Administración';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) Contact::unread()->count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del contacto')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Teléfono')
                            ->disabled(),
                        Forms\Components\TextInput::make('company')
                            ->label('Empresa')
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->label('Mensaje')
                            ->disabled()
                            ->rows(6),
                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Leído el'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->label('Empresa'),
                Tables\Columns\TextColumn::make('message')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Leído')
                    ->boolean()
                    ->getStateUsing(fn ($record) => $record->read_at !== null),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Recibido')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Actions\Action::make('markAsRead')
                    ->label('Marcar como leído')
                    ->icon('heroicon-o-check')
                    ->action(fn ($record) => $record->markAsRead())
                    ->visible(fn ($record) => $record->read_at === null),
                Actions\ViewAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
}
