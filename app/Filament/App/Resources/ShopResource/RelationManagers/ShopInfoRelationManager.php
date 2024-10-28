<?php

namespace App\Filament\App\Resources\ShopResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ShopInfoRelationManager extends RelationManager
{
    protected static string $relationship = 'shopInfo';
    protected static ?string $title = 'Thông tin của shop';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('banking_id')
                    ->relationship('Banking','name')
                    ->searchable()
                    ->label('Tên ngân hàng')
                    ->required(),
                TextInput::make('user_name_bank')
                    ->label('Tên tài khoản')
                    ->required(),
                TextInput::make('number_bank')
                    ->label('Số tài khoản')
                    ->minLength(16)
                    ->maxLength(19)
                    ->required(),
                TextInput::make('profile_number')
                    ->label('Thông tin')
                    ->columnSpan(2)
                    ->required(),
                FileUpload::make('front_side')
                    ->columnSpan(2)
                    ->required()
                    ->label('Mặt trước chứng minh nhân dân'),
                FileUpload::make('back_side')
                    ->columnSpan(2)
                    ->required()
                    ->label('Mặt sau chứng minh nhân dân'),
                FileUpload::make('portrait_photo')
                    ->columnSpan(2)
                    ->required()
                    ->label('Hình ảnh khuôn mặt'),
                FileUpload::make('national_id')
                    ->columnSpan(2)
                    ->required()
                    ->label('Giấy tùy thân'),
            ]);
    }

    public function table(Table $table): Table
    {
        $user = Auth::user();
        $shop = $user->shop;

        // Kiểm tra số lượng shopInfo tồn tại cho shop hiện tại chỉ được tạo một lần
        $shopInfoExists = $shop->shopInfo()->exists();
        return $table
            ->recordTitleAttribute('name_bank')
            ->columns([
                TextColumn::make('Shop.name')
                    ->searchable()
                    ->label('Tên cửa hàng'),
                TextColumn::make('Banking.name')
                    ->label('Tên ngân hàng')
                    ->searchable(),
                TextColumn::make('user_name_bank')
                    ->label('Tên tài khoản')
                    ->searchable(),
                TextColumn::make('number_bank')
                    ->label('Số tài khoản ngân hàng'),
                TextColumn::make('profile_number')
                    ->label('Thông tin'),
            ])
            ->filters([
                //
            ])
            ->headerActions($shopInfoExists ? [] : [
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
