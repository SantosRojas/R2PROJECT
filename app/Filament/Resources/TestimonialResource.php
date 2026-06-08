<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static string | UnitEnum | null $navigationGroup = 'Contenido';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('client_name')
                                    ->label('Nombre del cliente')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('client_position')
                                    ->label('Cargo')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('client_company')
                                    ->label('Empresa')
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Textarea::make('content')
                            ->label('Testimonio')
                            ->required()
                            ->rows(4),
                        Forms\Components\Select::make('rating')
                            ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])
                            ->default(5),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->image()
                            ->avatar()
                            ->maxFiles(1),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Activo')
                                    ->default(true),
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Orden')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->circular()
                    ->label(''),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_company')
                    ->label('Empresa'),
                Tables\Columns\TextColumn::make('content')
                    ->limit(60),
                Tables\Columns\TextColumn::make('rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐️', $state)),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Activo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Actions\EditAction::make(),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
