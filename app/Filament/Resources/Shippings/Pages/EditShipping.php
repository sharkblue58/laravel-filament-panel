<?php

namespace App\Filament\Resources\Shippings\Pages;

use App\Filament\Resources\Shippings\ShippingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditShipping extends EditRecord
{
    protected static string $resource = ShippingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        logger('the data before fill is ', $data);

        // Fill English fields
        $data['name_en'] = $this->record?->translate('en')?->name ?? null;
        $data['description_en'] = $this->record?->translate('en')?->description ?? null;

        // Fill Arabic fields
        $data['name_ar'] = $this->record?->translate('ar')?->name ?? null;
        $data['description_ar'] = $this->record?->translate('ar')?->description ?? null;

        return $data;
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['translations'] = [
            'en' => [
                'name' => $data['name_en'],
                'description' => $data['description_en'],
            ],

            'ar' => [
                'name' => $data['name_ar'],
                'description' => $data['description_ar'],
            ],
        ];

        unset(
            $data['name_en'],
            $data['description_en'],
            $data['name_ar'],
            $data['description_ar']
        );
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update main table columns
        $record->update([
            'price' => $data['price'],
        ]);

        // Update translations
        foreach ($data['translations'] as $locale => $translation) {
            $record->translateOrNew($locale)->name = $translation['name'];
            $record->translateOrNew($locale)->description = $translation['description'];
        }

        // Save translations
        $record->save();

        return $record;
    }
}
