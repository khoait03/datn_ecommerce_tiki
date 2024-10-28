<?php

namespace App\Filament\Resources\ReviewResource\RelationManagers;

use App\Models\Review;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewMediaRelationManager extends RelationManager
{
    protected static string $relationship = 'reviewMedia';
    protected static ?string $title = 'Ảnh đánh giá';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('review_media')->columnSpan('full')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->label('Ảnh'),
                Select::make('review_id')
                    ->relationship(name: 'review', titleAttribute: 'content')
                    ->options(Review::all()->pluck('content', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Chọn đánh giá'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('media')
            ->columns([
                ImageColumn::make('review_media')
                    ->label('Ảnh đánh giá'),
                TextColumn::make('review.content')
                    ->searchable()
                    ->label('Đánh giá'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
