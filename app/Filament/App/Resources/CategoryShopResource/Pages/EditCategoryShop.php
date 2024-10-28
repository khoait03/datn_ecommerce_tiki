<?php

namespace App\Filament\App\Resources\CategoryShopResource\Pages;

use App\Filament\App\Resources\CategoryShopResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryShop extends EditRecord
{
    protected static string $resource = CategoryShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
