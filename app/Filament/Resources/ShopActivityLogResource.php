<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopActivityLogResource\Pages;
use App\Filament\Resources\ShopActivityLogResource\RelationManagers;
use App\Models\ShopActivityLog;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ShopActivityLogResource extends Resource
{
    protected static ?string $model = ShopActivityLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $label = 'Nhật kí hoạt động';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('log_name')
                    ->label('Tên Log')
                    ->required(),
                MarkdownEditor::make('description')->columnSpan('full')
                    ->label('Mô tả')
                    ->required(),
                TextInput::make('causer_type')
                    ->label('Liên kết hoạt động')
                    ->required(),
                TextInput::make('properties')
                    ->label('Giá trị')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('log_name')
                    ->searchable()
                    ->label('Tên Log'),
                TextColumn::make('description')
                    ->searchable()
                    ->label('Mô tả'),
                TextColumn::make('causer_type')
                    ->searchable()
                    ->label('Liên kết hoạt động'),
                TextColumn::make('properties')
                    ->searchable()
                    ->label('Giá trị'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListShopActivityLogs::route('/'),
            'create' => Pages\CreateShopActivityLog::route('/create'),
            'edit' => Pages\EditShopActivityLog::route('/{record}/edit'),
        ];
    }
}
