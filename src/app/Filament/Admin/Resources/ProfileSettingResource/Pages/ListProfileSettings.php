<?php

namespace App\Filament\Admin\Resources\ProfileSettingResource\Pages;

use App\Filament\Admin\Resources\ProfileSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfileSettings extends ListRecords
{
    protected static string $resource = ProfileSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
