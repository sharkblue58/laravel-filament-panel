<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name = 'My Awesome Site';
    public string $phone = '+201234567890'; 
    public bool $site_active = true;
    public string $site_email = 'info@example.com';
    public string $site_logo = '/images/logo.png';
    public string $default_language = 'en';
    public string $timezone = 'Africa/Cairo';
    public static function group(): string
    {
        return 'general';
    }
}
