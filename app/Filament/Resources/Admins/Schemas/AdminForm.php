<?php

namespace App\Filament\Resources\Admins\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class AdminForm
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

                        TextInput::make('email')
                            ->label(__('message.email'))
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('password')
                            ->label(__('message.password'))
                            ->password()
                            ->required()
                            ->minLength(6)
                            ->dehydrateStateUsing(fn($state) => $state ? bcrypt($state) : null)
                            ->required(fn($context) => $context === 'create')
                            ->hiddenOn('edit'),
                    ])
            ]);
    }
}
