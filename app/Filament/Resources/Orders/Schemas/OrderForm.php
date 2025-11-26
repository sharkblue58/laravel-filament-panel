<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('message.order_information'))
                    ->schema([
                        Select::make('city_id')
                            ->relationship('city', 'name')
                            ->required(),

                        Select::make('shipping_id')
                            ->relationship('shipping', 'name')
                            ->required(),

                        TextInput::make('customer_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('customer_email')
                            ->email()
                            ->required(),

                        Select::make('status')
                            ->options(
                                collect(OrderStatus::cases())
                                    ->mapWithKeys(fn($status) => [$status->value => $status->label()])
                            )
                            ->required()
                            ->default(OrderStatus::Pending->value),

                        TextInput::make('billing_address'),

                        TextInput::make('shipping_address'),

                    ])
            ]);
    }
}
