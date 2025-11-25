<?php

use Illuminate\Support\Facades\DB;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        DB::table('settings')->insert([
            [
                'group' => 'general',
                'name' => 'site_name',
                'payload' => json_encode('My Awesome Site'),
                'locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'general',
                'name' => 'site_active',
                'payload' => json_encode(true),
                'locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'general',
                'name' => 'phone',
                'payload' => json_encode('+201234567890'),
                'locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'general',
                'name' => 'site_email',
                'payload' => json_encode('info@example.com'),
                'locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'general',
                'name' => 'site_logo',
                'payload' => json_encode('/images/logo.png'),
                'locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'general',
                'name' => 'default_language',
                'payload' => json_encode('en'),
                'locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group' => 'general',
                'name' => 'timezone',
                'payload' => json_encode('Africa/Cairo'),
                'locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    public function down(): void
    {
        DB::table('settings')->where('group', 'general')->delete();
    }
};
