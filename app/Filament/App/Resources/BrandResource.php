<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\BrandResource\Pages;
use App\Filament\App\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Sản phẩm';

    protected static ?string $label = 'Thương hiệu';
    // Chức năng search ( thanh tìm kiếm )
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')->columnSpan('full')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->label('Ảnh thương hiệu'),
                TextInput::make('name')
                    ->required()
                    ->label('Tên thương hiệu')
                    ->columnSpan('full'),
                MarkdownEditor::make('description')
                    ->columnSpan('full')
                    ->label('Mô tả'),
                Toggle::make('status')
                    ->label('Trạng thái'),
            ])->columns(2);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')
                    ->label('Tên tài khoản'),
                TextEntry::make('description')
                    ->label('Mô tả'),
                TextEntry::make('image')
                    ->label('Ảnh'),
                TextEntry::make('status')
                    ->label('Trạng thái')


            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tên thương hiệu')
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('image'),
                IconColumn::make('status')
                    ->label('Trạng thái')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-clock'),



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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'view' => Pages\ViewBrand::route('/{record}'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
