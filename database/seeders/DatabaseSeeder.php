<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(CountryCitySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ])->assignRole('user');

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super.admin@example.com',
        ])->assignRole('super admin');
    }
}
