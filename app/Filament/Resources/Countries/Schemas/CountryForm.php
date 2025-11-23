<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CountryForm
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
                        TextInput::make('name')
                            ->label(__('message.code'))
                            ->required()
                            ->maxLength(5),

                    ])
            ]);
    }
}
