<?php

namespace App\Filament\App\Resources\VoucherTypeResource\Pages;

use App\Filament\App\Resources\VoucherTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListVoucherTypes extends ListRecords
{
    protected static string $resource = VoucherTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): ?Builder
    {
        $user = Auth::user();
        if (Auth::user()?->hasRole('admin')){
            return parent::getTableQuery()->where('shop_id',$user->shop_id); // TODO: Change the autogenerated stub
        }
        return parent::getTableQuery(); // TODO: Change the autogenerated stub
    }
}