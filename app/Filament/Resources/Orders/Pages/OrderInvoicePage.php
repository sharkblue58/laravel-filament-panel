<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Orders\OrderResource;

class OrderInvoicePage extends ViewRecord
{
    protected static string $resource = OrderResource::class;
    protected  string $view = 'pages.order-invoice-page';

    public function getTitle(): string
    {
        return 'Export Invoice';
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function () {
                    $pdf = Pdf::loadView('pdf.invoice', [
                        'record' => $this->record,
                    ]);

                    $recipient = User::find(Auth::id());
                    logger($recipient);
                    Notification::make()
                        ->title('Invoice Exported')
                        ->body('Invoice has been exported successfully.')
                        ->actions([
                            Action::make('Mark as read')
                                ->icon('heroicon-s-check-circle')
                                ->color('warning')
                                ->button()
                                ->markAsRead(),
                        ])
                        ->sendToDatabase($recipient);

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, "invoice-{$this->record->id}.pdf");
                }),
        ];
    }
}
