<?php

namespace App\Filament\Resources;

use App\Enums\LikeRole;
use App\Filament\Resources\LikeResource\Pages;
use App\Filament\Resources\LikeResource\RelationManagers;
use App\Models\Like;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LikeResource extends Resource
{
    protected static ?string $model = Like::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-up';
    protected static ?string $label = 'Lượt yêu thích';
    protected static ?string $navigationGroup = 'Đánh giá';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Radio::make('status')
                    ->options(LikeRole::class)
                    ->label('Thích')
                    ->required(),
                Select::make('user_id')
                    ->relationship(name: 'User', titleAttribute: 'name')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Người thích'),
                Select::make('product_id')
                    ->relationship(name: 'Product', titleAttribute: 'name')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Sản phẩm'),
                Select::make('review_id')
                    ->relationship(name: 'Review', titleAttribute: 'content')
                    ->options(Review::all()->pluck('content', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Đánh giá'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->searchable()
                    ->label('Thích'),
                TextColumn::make('user.name')
                    ->searchable()
                    ->label('Người thích'),
                TextColumn::make('product.name')
                    ->searchable()
                    ->label('Sản phẩm'),
                TextColumn::make('review.content')
                    ->searchable()
                    ->label('Đánh giá'),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Người thích')
                    ->relationship('User', 'name'),
                SelectFilter::make('product_id')
                    ->label('Sản phẩm')
                    ->relationship('Product', 'name'),
            ], layout: FiltersLayout::AboveContentCollapsible)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLikes::route('/'),
            'create' => Pages\CreateLike::route('/create'),
            'edit' => Pages\EditLike::route('/{record}/edit'),
        ];
    }
}
