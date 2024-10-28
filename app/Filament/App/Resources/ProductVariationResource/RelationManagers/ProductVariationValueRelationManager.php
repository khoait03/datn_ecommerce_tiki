<?php

namespace App\Filament\App\Resources\ProductVariationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductVariationValueRelationManager extends RelationManager
{
    protected static string $relationship = 'productVariationValue';
    protected static ?string $label = 'Giá trị biến thể';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('variation_value_name')
                    ->required()
                    ->label('Tên giá trị biến thể'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('media')
            ->columns([
                TextColumn::make('variation_value_name')
                    ->label('Tên giá trị biến thể')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
