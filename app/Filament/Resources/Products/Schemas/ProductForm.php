<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(255),

                // Category
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name') 
                    ->required(),

                // Image
 /*                FileUpload::make('image')
                    ->label('Product Image')
                    ->image()
                    ->disk('s3')          //need to use s3
                    ->directory('products')
                    ->nullable(), */

                // Price
                TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->minValue(0),
            ]);
    }
}
