<?php

namespace App\Filament\Admin\Widgets;

use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentMessagesWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Pesan Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactMessage::query()->latest()->limit(10))
            ->columns([
                TextColumn::make('name')
                    ->label('Pengirim')
                    ->searchable()
                    ->weight('bold')
                    ->icon('heroicon-m-user'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->color('gray'),

                TextColumn::make('subject')
                    ->label('Subjek')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'     => 'danger',
                        'read'    => 'warning',
                        'replied' => 'success',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'new'     => '🔴 Baru',
                        'read'    => '👁️ Dibaca',
                        'replied' => '✅ Dibalas',
                        default   => ucfirst($state),
                    }),

                TextColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since()
                    ->color('gray'),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-m-eye')
                    ->color('warning')
                    ->visible(fn (ContactMessage $record) => $record->status === 'new')
                    ->action(fn (ContactMessage $record) => $record->markAsRead()),

                Tables\Actions\EditAction::make()->label('Balas'),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([5, 10])
            ->emptyStateHeading('Belum Ada Pesan')
            ->emptyStateDescription('Pesan dari form contact akan muncul di sini.')
            ->emptyStateIcon('heroicon-o-envelope');
    }
}
