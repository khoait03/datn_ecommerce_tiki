<?php

namespace App\Filament\App\Resources\VoucherResource\Pages;

use App\Filament\App\Resources\VoucherResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVoucher extends EditRecord
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
