<?php

namespace App\Filament\App\Resources\CategoryPostResource\Pages;

use App\Filament\App\Resources\CategoryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryPost extends EditRecord
{
    protected static string $resource = CategoryPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
