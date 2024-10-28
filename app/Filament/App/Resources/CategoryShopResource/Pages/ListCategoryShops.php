<?php

namespace App\Filament\App\Resources\CategoryShopResource\Pages;

use App\Filament\App\Resources\CategoryShopResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryShops extends ListRecords
{
    protected static string $resource = CategoryShopResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
