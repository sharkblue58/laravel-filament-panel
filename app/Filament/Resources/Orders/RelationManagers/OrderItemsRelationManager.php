<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Models\Product;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Actions\DissociateBulkAction;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Resources\RelationManagers\RelationManager;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'name')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $product = Product::find($state);
                            $set('price', $product->price);
                        }
                    })
                    ->unique(
                        modifyRuleUsing: function (\Illuminate\Validation\Rules\Unique $rule) {
                            return $rule->where('order_id', $this->getOwnerRecord()->id);
                        }
                    )
                    ->validationMessages([
                        'unique' => __('message.order_items_unique'),
                    ])
                    ->required(),

                TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->minValue(0)
                    ->required(),


                TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                TextInputColumn::make('quantity')
                    ->label('Quantity')
                    ->rules(['required', 'numeric', 'min:1'])
                    ->afterStateUpdated(function ($record, $state) {
                        $record->update(['quantity' => $state]);
                        $record->order->updateTotal();
                    }),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->getStateUsing(fn($record) => $record->quantity * $record->price)
                    ->money('USD')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->after(function ($record) {
                    $record->order->updateTotal();
                }),
                /*                 AssociateAction::make()->after(function ($record) {
                    $record->order->updateTotal();
                }), */
            ])
            ->recordActions([
                EditAction::make()->after(function ($record) {
                    $record->order->updateTotal();
                }),
                /*                 DissociateAction::make()->after(function ($record) {
                    $record->order->updateTotal();
                }), */
                DeleteAction::make()->after(function ($record) {
                    $record->order->updateTotal();
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    /*                     DissociateBulkAction::make()->after(function ($record) {
                        $record->order->updateTotal();
                    }), */
                    DeleteBulkAction::make()->after(function ($record) {
                        $record->order->updateTotal();
                    }),
                ]),
            ])
        ;
    }
}
