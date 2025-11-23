<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountryCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Egypt',
                'code' => 'EG',
                'cities' => ['Cairo', 'Alexandria'],
            ],
            [
                'name' => 'United States',
                'code' => 'US',
                'cities' => ['New York', 'Los Angeles'],
            ],
            [
                'name' => 'Germany',
                'code' => 'DE',
                'cities' => ['Berlin', 'Munich'],
            ],
            [
                'name' => 'France',
                'code' => 'FR',
                'cities' => ['Paris', 'Lyon'],
            ],
            [
                'name' => 'Saudi Arabia',
                'code' => 'SA',
                'cities' => ['Riyadh', 'Jeddah'],
            ],
        ];

        foreach ($countries as $countryData) {
            $country = Country::create([
                'name' => $countryData['name'],
                'code' => $countryData['code'],
            ]);

            foreach ($countryData['cities'] as $cityName) {
                City::create([
                    'country_id' => $country->id,
                    'name' => $cityName,
                ]);
            }
        }
    }
}
