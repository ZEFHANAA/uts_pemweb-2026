<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ExperienceResource\Pages;
use App\Filament\Admin\Resources\ExperienceResource\RelationManagers;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Experiences';

    protected static ?string $navigationGroup = 'Management';

    protected static ?string $modelLabel = 'Experience';

    protected static ?string $pluralModelLabel = 'Experiences';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Pengalaman')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('year')
                            ->label('Tahun')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., 2026 atau 2024 - 2025'),

                        Forms\Components\TextInput::make('title')
                            ->label('Judul Pengalaman')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('color')
                            ->label('Warna Badge')
                            ->options([
                                'indigo' => 'Indigo',
                                'purple' => 'Purple',
                                'pink' => 'Pink',
                                'emerald' => 'Emerald',
                                'blue' => 'Blue',
                            ])
                            ->required()
                            ->default('indigo'),

                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->required()
                            ->default(0),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->maxLength(1000)
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('color')
                    ->label('Warna')
                    ->badge()
                    ->color(fn (string $state): string => $state)
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
