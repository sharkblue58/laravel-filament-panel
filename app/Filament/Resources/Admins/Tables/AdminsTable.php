<?php

namespace App\Filament\Resources\Admins\Tables;

use App\Models\User;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use STS\FilamentImpersonate\Actions\Impersonate;

class AdminsTable
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
                TextColumn::make('email')
                    ->label(__('message.email'))
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
                //
            ])
            ->recordActions([
                Impersonate::make(),
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make()->after(function (DeleteAction $action, $record) {
                    $recipient = User::find(Auth::id());
                    logger($recipient);
                    Notification::make()
                        ->title(__('message.delete_title', ['name' => __('message.admin')]))
                        ->body(__('message.delete_message', ['id' => $record->id]))
                        ->actions([
                            Action::make('Mark as read')
                                ->icon('heroicon-s-check-circle')
                                ->color('warning')
                                ->button()
                                ->markAsRead(),
                        ])
                        ->sendToDatabase($recipient);
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
