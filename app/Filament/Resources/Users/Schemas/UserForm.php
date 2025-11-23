<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('message.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(__('message.email'))
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label(__('message.password'))
                    ->password()
                    ->minLength(6)
                    ->dehydrateStateUsing(fn($state) => $state ? bcrypt($state) : null)
                    ->required(fn($context) => $context === 'create')
                    ->hiddenOn('edit'),
            ]);
    }
}
