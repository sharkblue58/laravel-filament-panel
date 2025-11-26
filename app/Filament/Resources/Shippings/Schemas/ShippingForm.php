<?php

namespace App\Filament\Resources\Shippings\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;

class ShippingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Shipping Information')
                ->description('Enter the basic details of the shipping')
                ->schema([
                    TextInput::make('price')->numeric()->required(),
                    Tabs::make('Translations')
                        ->tabs([
                            Tabs\Tab::make('English')->schema([
                                TextInput::make('name_en')
                                    ->label('Name (English)')
                                    ->required(),
                                Textarea::make('description_en')
                                    ->label('Description (English)')
                                    ->required(),
                            ]),

                            Tabs\Tab::make('Arabic')->schema([
                                TextInput::make('name_ar')
                                    ->label('Name (Arabic)')
                                    ->required(),
                                Textarea::make('description_ar')
                                    ->label('Description (Arabic)')
                                    ->required(),
                            ]),
                        ]),
                ])
            ])->columns(1);
    }
}
