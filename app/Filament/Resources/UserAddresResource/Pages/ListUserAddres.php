<?php

namespace App\Filament\Resources\UserAddresResource\Pages;

use App\Filament\Resources\UserAddresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserAddres extends ListRecords
{
    protected static string $resource = UserAddresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
