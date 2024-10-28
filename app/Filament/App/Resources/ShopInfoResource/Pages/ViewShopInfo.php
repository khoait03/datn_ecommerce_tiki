<?php

namespace App\Filament\App\Resources\ShopInfoResource\Pages;

use App\Filament\App\Resources\ShopInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewShopInfo extends ViewRecord
{
    protected static string $resource = ShopInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
