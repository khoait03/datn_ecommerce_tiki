<?php

namespace App\Filament\Resources\UserAddresResource\Pages;

use App\Filament\Resources\UserAddresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserAddres extends EditRecord
{
    protected static string $resource = UserAddresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
