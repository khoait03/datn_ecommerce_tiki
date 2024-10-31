<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Filament\Resources\ShippingAddressResource\Pages;
use App\Filament\Resources\ShippingAddressResource\RelationManagers;
use App\Models\ShippingAddress;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;



class ShippingAddressResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = ShippingAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Đơn hàng';
    protected static ?string $label = 'Địa chỉ đơn hàng';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Tên người dùng'),
                Select::make('order_id')
                    ->required()
                    ->relationship(name: 'Order', titleAttribute: 'code')
                    ->label('Mã đơn hàng'),
                TextInput::make('phone')
                    ->required()
                    ->numeric()
                    ->maxLength(13)
                    ->minLength(10)
                    ->label('Số điện thoại người dùng'),
                TextInput::make('street')
                    ->required()
                    ->label('Địa chỉ cụ thế'),
                Select::make('province_id')
                    ->relationship(name: 'Province', titleAttribute: 'name')
                    ->label('Tỉnh'),
                Select::make('district_id')
                    ->relationship(name: 'District', titleAttribute: 'name')
                    ->label('Quận'),
                Select::make('ward_id')
                    ->relationship(name: 'Ward', titleAttribute: 'name')
                    ->label('Phường'),
                Select::make('user_id')
                    ->required()
                    ->relationship(name: 'User', titleAttribute: 'name')
                    ->label('Mã người dùng'),
                Toggle::make('status')
                    ->required()
                    ->label('Trạng thái'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('code')
                    ->badge()
                    ->label('Mã đơn hàng'),
                TextEntry::make('name')
                    ->label('Tên người dùng'),
                TextEntry::make('phone')
                    ->label('Số điện thoại'),
                TextEntry::make('street')
                    ->label('Địa chỉ cụ thể'),
                TextEntry::make('Province.name')
                    ->label('Thành phố'),
                TextEntry::make('District.name')
                    ->label('Quận'),
                TextEntry::make('Ward.name')
                    ->label('Phường'),
                TextEntry::make('Order.code')
                    ->label('Mã đơn hàng'),
                TextEntry::make('User.name')
                    ->label('Người dùng'),
                TextEntry::make('status')
                    ->label('Nhà bán'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Tên người dùng'),
                TextColumn::make('phone')
                    ->searchable()
                    ->label('Số điện thoại'),
                TextColumn::make('street')
                    ->searchable()
                    ->label('Địa chỉ cụ thể'),
//                TextColumn::make('Province.name')
//                    ->searchable()
//                    ->label('Thành phố'),
//                TextColumn::make('District.name')
//                    ->searchable()
//                    ->label('Quận'),
//                TextColumn::make('Ward.name')
//                    ->searchable()
//                    ->label('Phường'),
                TextColumn::make('Order.code')
                    ->searchable()
                    ->label('Mã đơn hàng'),
                TextColumn::make('User.name')
                    ->searchable()
                    ->label('Người dùng'),
//                TextColumn::make('status')
//                    ->searchable()
//                    ->label('Nhà bán'),
            ])
            ->filters([
                SelectFilter::make('order_id')
                    ->label('Địa chỉ người dùng')
                    ->relationship(name: 'Order', titleAttribute: 'code'),
                SelectFilter::make('province_id')
                    ->relationship(name: 'Province', titleAttribute: 'name')
                    ->label('Sản phẩm'),
                SelectFilter::make('district_id')
                    ->relationship(name: 'District', titleAttribute: 'name')
                    ->label('Trạng thái đơn hàng'),
                SelectFilter::make('ward_id')
                    ->relationship(name: 'Ward', titleAttribute: 'name')
                    ->label('Phương thức thanh toán'),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShippingAddresses::route('/'),
            'create' => Pages\CreateShippingAddress::route('/create'),
            'edit' => Pages\EditShippingAddress::route('/{record}/edit'),
        ];
    }
}
