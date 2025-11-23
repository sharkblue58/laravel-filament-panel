<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('message.category_information'))
                    //->description('Enter the basic details of the category')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('message.name'))
                            ->required()
                            ->maxLength(255)
                            ->autofocus(),

                        Textarea::make('description')
                            ->label(__('message.description'))
                            ->nullable()
                            ->rows(3)
                            ->maxLength(500)
                            ,
                    ])
            ]);
    }
}
