<?php

namespace App\Filament\Resources\ShopActivityLogResource\Pages;

use App\Filament\Resources\ShopActivityLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopActivityLogs extends ListRecords
{
    protected static string $resource = ShopActivityLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
