<?php

namespace App\Filament\App\Resources\ShopResource\Pages;

use App\Filament\App\Resources\ShopResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewShop extends ViewRecord
{
    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
