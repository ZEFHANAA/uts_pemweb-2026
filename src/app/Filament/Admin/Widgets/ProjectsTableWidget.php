<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Project;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ProjectsTableWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Daftar Projects';

    public function table(Table $table): Table
    {
        return $table
            ->query(Project::query()->ordered())
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->title) . '&background=4f46e5&color=fff&size=80')
                    ->size(40),

                TextColumn::make('title')
                    ->label('Judul Project')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Project $record): string => \Str::limit($record->description, 60)),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed'   => 'success',
                        'in-progress' => 'info',
                        'planning'    => 'warning',
                        'on-hold'     => 'danger',
                        default       => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('-', ' ', $state))),

                TextColumn::make('progress')
                    ->label('Progress')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state >= 100 => 'success',
                        $state >= 60  => 'info',
                        $state >= 30  => 'warning',
                        default       => 'danger',
                    }),

                TextColumn::make('technologies')
                    ->label('Teknologi')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', array_slice($state, 0, 3)) : $state)
                    ->limit(40)
                    ->color('gray'),

                TextColumn::make('is_featured')
                    ->label('Featured')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? '⭐ Ya' : 'Tidak')
                    ->color(fn ($state): string => $state ? 'warning' : 'gray'),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable()
                    ->color('gray'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
            ])
            ->defaultSort('order', 'asc')
            ->paginated([5, 10]);
    }
}
