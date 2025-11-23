<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ExportAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Exports\CategoryExporter;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('message.id'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('message.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(__('message.description'))
                    ->searchable(),
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
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->headerActions([
                ExportAction::make()
                    ->exporter(CategoryExporter::class),
            ]);
    }
}
