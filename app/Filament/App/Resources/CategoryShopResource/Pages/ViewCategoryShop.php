<?php

namespace App\Filament\App\Resources\CategoryShopResource\Pages;

use App\Filament\App\Resources\CategoryShopResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoryShop extends ViewRecord
{
    protected static string $resource = CategoryShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
