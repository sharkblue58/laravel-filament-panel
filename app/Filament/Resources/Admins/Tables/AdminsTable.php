<?php

namespace App\Filament\Resources\Admins\Tables;

use App\Models\User;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use STS\FilamentImpersonate\Actions\Impersonate;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                TrashedFilter::make(),
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
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

}
