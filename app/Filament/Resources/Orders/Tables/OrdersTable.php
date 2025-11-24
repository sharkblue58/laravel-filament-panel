<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatus;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextInputColumn;


class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('city.name')
                    ->label('City')
                    ->searchable()
                    ->sortable(),

                TextInputColumn::make('customer_name')
                    ->rules(['required','string','max:255'])
                    ->searchable(),

                TextColumn::make('customer_email')
                    ->searchable(),

                SelectColumn::make('status')
                    ->searchableOptions()
                    ->options(
                        collect(OrderStatus::cases())
                            ->mapWithKeys(fn($case) => [
                                $case->value => $case->label()
                            ])
                    )
                 ->rules(['required'])
                ,

                TextColumn::make('total')
                    ->label('Price')
                    ->money('USD', true)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('message.created_at'))
                    ->icon('heroicon-o-calendar')
                    ->datetime('d/m/Y h:i A'),

                TextColumn::make('updated_at')
                    ->label(__('message.updated_at'))
                    ->icon('heroicon-o-calendar')
                    ->datetime('d/m/Y h:i A'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
