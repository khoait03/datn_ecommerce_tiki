<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserAddresResource\Pages;
use App\Filament\Resources\UserAddresResource\RelationManagers;
use App\Models\District;
use App\Models\Province;
use App\Models\UserAddress;
use App\Models\Ward;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class UserAddresResource extends Resource
{
    protected static ?string $model = UserAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $label = 'Địa chỉ người dùng';
    protected static ?string $navigationGroup = 'Thông tin người dùng';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->filled()
                    ->label('Tên tài khoản')
                    ->columnSpan(2),

                Select::make('user_id')
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->required()
                    ->filled()
                    ->label('Tên người dùng'),

                TextInput::make('phone')
                    ->label('SĐT')
                    ->required()
                    ->Length(10)
                    ->regex('/^0\d{9}/'),

                Fieldset::make('Địa chỉ')
                    ->schema([
                        Select::make('province_id')
                            ->label('Thành phố/Tỉnh')
                            ->filled()
                            ->reactive()
                            ->options(Province::query()
                                ->pluck('name', 'id'))
                            ->live(),
                        Select::make('district_id')
                            ->reactive()
                            ->label('Quận/Huyện')
                            ->filled()
                            ->options(fn(Get $get): Collection => District::query()
                                ->where('province_id', $get('province_id'))
                                ->pluck('name', 'id'))
                            ->live(),
                        Select::make('ward_id')
                            ->reactive()
                            ->filled()
                            ->label('Phường/Xã')
                            ->options(fn(Get $get): Collection => Ward::query()
                                ->where('district_id', $get('district_id'))
                                ->pluck('name', 'id'))
                            ->nullable()
                            ->live(),
                    ])
                    ->columns(3),
                MarkdownEditor::make('address_specific')->label('Địa chỉ cụ thể')
                    ->filled()
                    ->columnSpan(2),

            ]);

    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')
                    ->label('Tên tài khoản'),
                TextEntry::make('user.name')
                    ->label('Tên người dùng'),
                TextEntry::make('phone')
                    ->label('Số điện thoại'),
                TextEntry::make('province.name')
                    ->label('Tỉnh/thành'),
                TextEntry::make('district.name')
                    ->label('Huận/huyện'),
                TextEntry::make('ward.name')
                    ->label('Phường/xã'),
                TextEntry::make('address_specific')
                    ->label('Địa chỉ cụ thể')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->icon('heroicon-m-user-circle')
                    ->label('Tên tài khoản')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->icon('heroicon-m-user-circle')
                    ->label('Tên người dùng')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->searchable(),
                TextColumn::make('province.name')
                    ->label('Thành phố/Tỉnh'),

                TextColumn::make('district.name')
                    ->label('Quận/Huyện'),

                TextColumn::make('ward.name')
                    ->label('Phường/Xã'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUserAddres::route('/'),
            'create' => Pages\CreateUserAddres::route('/create'),
            'edit' => Pages\EditUserAddres::route('/{record}/edit'),
        ];
    }
}
