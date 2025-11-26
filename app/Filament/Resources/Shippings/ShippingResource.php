<?php

namespace App\Filament\Resources\Shippings;

use App\Filament\Resources\Shippings\Pages\CreateShipping;
use App\Filament\Resources\Shippings\Pages\EditShipping;
use App\Filament\Resources\Shippings\Pages\ListShippings;
use App\Filament\Resources\Shippings\Schemas\ShippingForm;
use App\Filament\Resources\Shippings\Tables\ShippingsTable;
use App\Models\Shipping;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShippingResource extends Resource
{
    protected static ?string $model = Shipping::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Truck;

    public static function form(Schema $schema): Schema
    {
        return ShippingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShippingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => ListShippings::route('/'),
            'create' => CreateShipping::route('/create'),
            'edit' => EditShipping::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('message.order_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('message.shipping');
    }

    public static function getPluralLabel(): string
    {
        return __('message.shipping');
    }

    public static function getModelLabel(): string
    {
        return __('message.shipping');
    }
}
