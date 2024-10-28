<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $label = 'Người dùng';

    protected static ?string $navigationGroup = 'Thông tin người dùng';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                FileUpload::make('avatar')
                    ->columnSpan(2)
                    ->label('Ảnh đại diện'),
                TextInput::make('name')
                    ->required()
                    ->label('Tên tài khoản'),
                TextInput::make('email')
                    ->required()
                    ->regex('/^.+@.+$/i')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Tài khoản đã được đăng kí.',
                    ]),
                TextInput::make('password')
                    ->required()
                    ->label('Mật khẩu')
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->minLength(6)
                    ->maxLength(16)
                    ->password()
                    ->filled()
                    ->unique(ignoreRecord: true)
                    ->autocomplete('new-password'),
                TextInput::make('phone')
                    ->label('SĐT')
                    ->required()
                    ->tel(),
                DatePicker::make('birthday')
                    ->required()
                    ->label('Ngày sinh'),

                Select::make('gender')
                    ->options(UserRole::class)
                    ->label('Giới tính')
                    ->required(),

                Select::make('shop_id')
                    ->relationship(name: 'shop', titleAttribute: 'name')
                    ->required()
                    ->label('Cửa hàng'),

                TextInput::make('verification_code')
                    ->hidden()
                    ->label('Mã xác thực tài khoản'),

                Fieldset::make('Địa chỉ')
                    ->schema([
                        Select::make('province_id')
                            ->label('Thành phố/Tỉnh')
                            ->required()
                            ->reactive()
                            ->options(Province::query()
                                ->pluck('name', 'id'))
                            ->live(),
                        Select::make('district_id')
                            ->required()
                            ->reactive()
                            ->label('Quận/Huyện')
                            ->options(fn(Get $get): Collection => District::query()
                                ->where('province_id', $get('province_id'))
                                ->pluck('name', 'id'))
                            ->live(),
                        Select::make('ward_id')
                            ->required()
                            ->reactive()
                            ->label('Phường/Xã')
                            ->options(fn(Get $get): Collection => Ward::query()
                                ->where('district_id', $get('district_id'))
                                ->pluck('name', 'id'))
                            ->nullable()
                            ->live(),
                    ])
                    ->columns(3),
               Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')
                    ->label('Tên tài khoản'),
                TextEntry::make('email')
                    ->label('Email'),
                TextEntry::make('phone')
                    ->label('SĐT'),
                TextEntry::make('birthday')
                    ->label('Ngày sinh'),
                TextEntry::make('gender')
                    ->label('Giới tính'),
                TextEntry::make('province.name')
                    ->label('Tỉnh/thành'),
                TextEntry::make('district.name')
                    ->label('Huận/huyện'),
                TextEntry::make('ward.name')
                    ->label('Phường/xã'),
                TextEntry::make('shop.name')
                    ->label('Cửa hàng'),
                TextEntry::make('verification_code')
                    ->label('Mã xác thực'),
                TextEntry::make('paymentMethod.method_name')
                    ->label('Phương thức thanh toán'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Tên tài khoản')
                    ->searchable(),
                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->label('Email'),
                TextColumn::make('roles.name')
                    ->badge()
                    ->label('Vai trò')
                    ->separator(','),
                TextColumn::make('phone')
                    ->label('SĐT')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Giới tính'),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
