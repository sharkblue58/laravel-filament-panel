<?php

namespace App\Filament\Resources\Cities\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('message.admin_information'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('message.name'))
                            ->required()
                            ->maxLength(255),
                        Select::make('country_id')
                            ->label(__('message.country'))
                            ->relationship('country', 'name')   // country() relation in City model
                            ->searchable()
                            ->preload()
                            ->required()

                    ])
            ]);
    }
}
