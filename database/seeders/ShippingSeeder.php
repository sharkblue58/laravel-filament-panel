<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippings = [
            [
                'price' => 5.00,
                'translations' => [
                    'en' => ['name' => 'Standard', 'description' => 'Delivered in 3-5 business days'],
                    'ar' => ['name' => 'عادي', 'description' => 'يتم التوصيل خلال 3-5 أيام عمل'],
                ],
            ],
            [
                'price' => 10.00,
                'translations' => [
                    'en' => ['name' => 'Express', 'description' => 'Delivered in 1-2 business days'],
                    'ar' => ['name' => 'سريع', 'description' => 'يتم التوصيل خلال 1-2 يوم عمل'],
                ],
            ],
            [
                'price' => 20.00,
                'translations' => [
                    'en' => ['name' => 'Next Day', 'description' => 'Delivered by next day'],
                    'ar' => ['name' => 'اليوم التالي', 'description' => 'يتم التوصيل خلال يوم'],
                ],
            ],
        ];

        foreach ($shippings as $data) {
            $shipping = Shipping::create(['price' => $data['price']]); // only price

            // now create translations
            foreach ($data['translations'] as $locale => $translation) {
                $shipping->translateOrNew($locale)->name = $translation['name'];
                $shipping->translateOrNew($locale)->description = $translation['description'];
            }

            $shipping->save();
        }
    }
}
