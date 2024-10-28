<?php

namespace App\Filament\App\Resources\ProductVariationResource\Pages;

use App\Filament\App\Resources\ProductVariationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductVariation extends EditRecord
{
    protected static string $resource = ProductVariationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
