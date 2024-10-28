<?php

namespace App\Filament\App\Resources\ProductVariationResource\Pages;

use App\Filament\App\Resources\ProductVariationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductVariation extends ViewRecord
{
    protected static string $resource = ProductVariationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
