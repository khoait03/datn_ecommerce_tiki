<?php

namespace App\Filament\Resources;

use App\Enums\RatingRole;
use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;


class ReviewResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $label = 'Đánh giá';
    protected static ?string $navigationGroup = 'Đánh giá';
    /**
     * @throws \Exception
     */

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
                FileUpload::make('image')->columnSpan('full')
                    ->image()
                    ->imageEditor()
                    ->label('Ảnh'),
                Select::make('review_id')
                    ->relationship(name: 'reviewChild', titleAttribute: 'content')
                    ->options(Review::all()->pluck('content', 'id'))
                    ->searchable()
                    ->label('Chọn đánh giá để phản hồi'),
                Select::make('user_id')
                    ->relationship(name: 'User', titleAttribute: 'name')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Người đánh giá'),

                Select::make('rating')
                    ->options(RatingRole::class)
                    ->required()
                    ->label('Đánh giá'),
                TextInput::make('like_count')
                    ->label('Lượt thích')
                    ->required()
                    ->numeric()
                    ->rules('min:0'),
                Select::make('product_id')
                    ->relationship(name: 'product', titleAttribute: 'name')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Sản phẩm'),
                MarkdownEditor::make('content')
                    ->label('Nội dung')
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Ảnh đánh giá'),
                TextColumn::make('User.name')
                    ->searchable()
                    ->label('Tên người đánh giá'),
                TextColumn::make('content')
                    ->label('Nội dung')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Đánh giá')
                    ->searchable(),
                TextColumn::make('like_count')
                    ->label('Lượt thích')
                    ->searchable(),
                TextColumn::make('Product.name')
                    ->searchable()
                    ->label('Tên sản phẩm'),
                TextColumn::make('Review.content')
                    ->searchable()
                    ->label('Phản hồi'),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Người đánh giá')
                    ->relationship('User', 'name'),
                SelectFilter::make('product_id')
                    ->label('Danh Mục')
                    ->relationship('Product', 'name'),
            ],)
            ->actions([
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
            RelationManagers\ReviewMediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
