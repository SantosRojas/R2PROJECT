<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-folder';

    protected static string | UnitEnum | null $navigationGroup = 'Contenido';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return (string) Project::where('is_active', true)->count();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'primary';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del proyecto')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                            ]),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\RichEditor::make('description')
                            ->label('Descripción corta')
                            ->maxLength(500),
                        Forms\Components\RichEditor::make('content')
                            ->label('Contenido completo')
                            ->columnSpanFull(),
                    ]),

                Section::make('Cliente')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('client_name')
                                    ->label('Nombre del cliente')
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('completion_date')
                                    ->label('Fecha de finalización'),
                                Forms\Components\TextInput::make('project_url')
                                    ->label('URL del proyecto')
                                    ->url()
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('Galería de imágenes')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple()
                            ->image()
                            ->maxFiles(10)
                            ->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->image()
                            ->maxFiles(1)
                            ->columnSpanFull(),
                    ]),

                Section::make('Configuración')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Destacado'),
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail')
                    ->label(''),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Destacado'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Activo'),
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Cliente')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('completion_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Destacados'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Activos'),
            ])
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
