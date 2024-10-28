<?php

namespace App\Filament\App\Resources\ShopInfoResource\Pages;

use App\Filament\App\Resources\ShopInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShopInfo extends EditRecord
{
    protected static string $resource = ShopInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
