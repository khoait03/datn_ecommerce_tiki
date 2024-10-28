<?php

namespace App\Filament\App\Resources\VoucherTypeResource\Pages;

use App\Filament\App\Resources\VoucherTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVoucherType extends ViewRecord
{
    protected static string $resource = VoucherTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
