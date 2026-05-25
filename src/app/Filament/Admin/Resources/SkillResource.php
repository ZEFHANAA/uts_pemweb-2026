<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SkillResource\Pages;
use App\Filament\Admin\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationLabel = 'Skills';

    protected static ?string $navigationGroup = 'Management';

    protected static ?string $modelLabel = 'Skill';

    protected static ?string $pluralModelLabel = 'Skills';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Keahlian')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Keahlian')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('group')
                            ->label('Kategori')
                            ->options([
                                'backend' => 'Backend',
                                'frontend' => 'Frontend',
                                'database' => 'Database',
                                'devops' => 'DevOps & Tools',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('level')
                            ->label('Persentase Keahlian (%)')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(100),

                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->required()
                            ->default(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Keahlian')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('group')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'backend' => 'indigo',
                        'frontend' => 'purple',
                        'database' => 'emerald',
                        'devops' => 'orange',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'backend' => 'Backend',
                        'frontend' => 'Frontend',
                        'database' => 'Database',
                        'devops' => 'DevOps & Tools',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('level')
                    ->label('Tingkat')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Kategori')
                    ->options([
                        'backend' => 'Backend',
                        'frontend' => 'Frontend',
                        'database' => 'Database',
                        'devops' => 'DevOps & Tools',
                    ]),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
