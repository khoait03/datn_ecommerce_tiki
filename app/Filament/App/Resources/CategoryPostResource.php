<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CategoryPostResource\Pages;
use App\Filament\App\Resources\CategoryPostResource\RelationManagers;
use App\Models\CategoryPost;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CategoryPostResource extends Resource
{
    protected static ?string $model = CategoryPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationGroup = 'Bài viết';

    protected static ?string $label = 'Danh mục bài viết';
    // Chức năng search ( thanh tìm kiếm )
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Tên danh mục')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable(),
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
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Auth::check()) {
            $shopId = Auth::user()->shop_id;
            return $query->where('shop_id', $shopId);
        }

        return $query;
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
            'index' => Pages\ListCategoryPosts::route('/'),
            'create' => Pages\CreateCategoryPost::route('/create'),
            'view' => Pages\ViewCategoryPost::route('/{record}'),
            'edit' => Pages\EditCategoryPost::route('/{record}/edit'),
        ];
    }
}
