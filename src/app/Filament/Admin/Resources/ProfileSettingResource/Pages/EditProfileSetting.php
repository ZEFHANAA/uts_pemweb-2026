<?php

namespace App\Filament\Admin\Resources\ProfileSettingResource\Pages;

use App\Filament\Admin\Resources\ProfileSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfileSetting extends EditRecord
{
    protected static string $resource = ProfileSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
