<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $label = 'Bài viết';
    protected static ?string $navigationGroup = 'Bài viết';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('thumbnail')
                    ->required()
                    ->columnSpan(2)
                    ->label('Ảnh đại diện'),
                Select::make('category_post_id')
                    ->relationship(name: 'CategoryPost', titleAttribute: 'name')
                    ->required()
                    ->options(CategoryPost::all()->pluck('name', 'id'))
                    ->searchable()
                    ->label('Danh mục'),
                TextInput::make('title')
                    ->label('Tiêu đề bài viết')
                    ->required(),
                TextInput::make('slug')
                    ->label('Đường dẫn bài viết')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Đường dẫn đã tồn tại.',
                    ]),
                TextInput::make('meta_title')
                    ->label('Tiêu đề SEO')
                    ->maxLength(100)
                    ->required(),
                TagsInput::make('meta_keyword')
                    ->label('Từ khóa SEO')
                    ->required(),
                TagsInput::make('tags')
                    ->label('Nhãn bài viết')
                    ->required(),
                Textarea::make('meta_description')
                    ->label('Mô tả SEO')
                    ->required()
                    ->maxLength(155)
                    ->columnSpan(2),
                RichEditor::make('content')
                    ->label('Nội dung')
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('title')
                    ->label('Tiêu đề bài viết'),
                TextEntry::make('CategoryPost.name')
                    ->label('Danh mục bài viết'),
                TextEntry::make('slug')
                    ->label('Đường dẫn bài viết'),
                TextEntry::make('content')
                    ->label('Nội dung bài viết'),
                TextEntry::make('meta_title')
                    ->label('Tiêu đề SEO'),
                TextEntry::make('meta_keyword')
                    ->label('Từ khóa SEO'),
                TextEntry::make('User.name')
                    ->label('Người đăng bài'),
                TextEntry::make('tags')
                    ->label('Nhãn bài viết'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Hình ảnh')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Tiêu đề bài viết')
                    ->searchable(),
                TextColumn::make('CategoryPost.name')
                    ->label('Danh mục bài viết')
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Đường dẫn bài viết')
                    ->searchable(),
                TextColumn::make('User.name')
                    ->label('Người đăng bài')
                    ->searchable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
