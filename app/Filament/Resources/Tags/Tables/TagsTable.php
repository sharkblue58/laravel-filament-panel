<?php

namespace App\Filament\Resources\Tags\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ExportAction;
use Filament\Tables\Filters\Filter;
use App\Filament\Exports\TagExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class TagsTable
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
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
                    ->exporter(TagExporter::class),
            ]);
    }
}
