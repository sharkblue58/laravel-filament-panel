<?php

namespace App\Filament\Resources\Shippings\Pages;

use App\Filament\Resources\Shippings\ShippingResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateShipping extends CreateRecord
{
    protected static string $resource = ShippingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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
       // logger('the mutated data is ', $data);
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
      //  logger('the creating data is ', $data);
        $shipping =  static::getModel()::create(['price' => $data['price']]);
        foreach ($data['translations'] as $locale => $translation) {
            $shipping->translateOrNew($locale)->name = $translation['name'];
            $shipping->translateOrNew($locale)->description = $translation['description'];
        }

        $shipping->save();

        return $shipping;
    }
}
