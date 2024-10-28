<?php

namespace App\Filament\Resources\ShopActivityLogResource\Pages;

use App\Filament\Resources\ShopActivityLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShopActivityLog extends EditRecord
{
    protected static string $resource = ShopActivityLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
