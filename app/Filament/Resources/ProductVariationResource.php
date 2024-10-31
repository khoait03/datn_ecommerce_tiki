<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductVariationResource\Pages;
use App\Filament\Resources\ProductVariationResource\RelationManagers;
use App\Models\ProductVariation;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;


class ProductVariationResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = ProductVariation::class;

    protected static ?string $navigationGroup = 'Sản phẩm';
    protected static ?string $label = 'Biến thể';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

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
                Select::make('product_id')
                    ->required()
                    ->label('Mã sản phẩm')
                    ->relationship(name: 'Product', titleAttribute: 'name'),
                TextInput::make('variation_name')
                    ->required()
                    ->label('Tên biến thể'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Product.name')
                    ->label('Mã sản phẩm')
                    ->searchable(),
                TextColumn::make('variation_name')
                    ->label('Tên biến thể')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('product_id')
                    ->label('Mã sản phẩm')
                    ->relationship('Product', 'name'),
            ])
            ->actions([
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
            RelationManagers\ProductVariationValueRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductVariations::route('/'),
            'create' => Pages\CreateProductVariation::route('/create'),
            'edit' => Pages\EditProductVariation::route('/{record}/edit'),
        ];
    }
}
