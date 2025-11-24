<?php

namespace App\Filament\Resources\Orders\Pages;

use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
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

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, "invoice-{$this->record->id}.pdf");
                }),
        ];
    }
}
