<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Mobile phones, laptops, and smart devices.',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothes, shoes, and accessories.',
            ],
            [
                'name' => 'Home & Kitchen',
                'description' => 'Appliances, tools, and cookware.',
            ],
            [
                'name' => 'Beauty',
                'description' => 'Cosmetics, skincare, and personal care items.',
            ],
            [
                'name' => 'Sports',
                'description' => 'Gym equipment, sportswear, and accessories.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
