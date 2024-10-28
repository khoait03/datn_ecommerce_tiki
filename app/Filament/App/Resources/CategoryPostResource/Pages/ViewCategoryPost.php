<?php

namespace App\Filament\App\Resources\CategoryPostResource\Pages;

use App\Filament\App\Resources\CategoryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoryPost extends ViewRecord
{
    protected static string $resource = CategoryPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
