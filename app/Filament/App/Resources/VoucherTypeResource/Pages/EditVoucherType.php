<?php

namespace App\Filament\App\Resources\VoucherTypeResource\Pages;

use App\Filament\App\Resources\VoucherTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVoucherType extends EditRecord
{
    protected static string $resource = VoucherTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
