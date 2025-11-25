<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use App\Settings\GeneralSettings;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Schemas\Concerns\InteractsWithSchemas;

class GeneralSettingsPage extends Page implements HasSchemas
{
    use InteractsWithSchemas;
    protected string $view = 'filament.pages.general-settings-page';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog8Tooth;


    public ?array $data = [];
    public function mount(): void
    {
        $general = app(GeneralSettings::class);

        $this->data = [
            'site_name' => $general->site_name,
            'site_active' => $general->site_active,
            'phone' => $general->phone,
            'site_email' => $general->site_email,
            'default_language' => $general->default_language,
            'timezone' => $general->timezone
        ];

        $this->form->fill($this->data);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Site Settings')
                    ->description('General information about your website')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->placeholder('Enter your site name'),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->placeholder('+201234567890'),

                        TextInput::make('site_email')
                            ->label('Site Email')
                            ->email()
                            ->placeholder('info@example.com'),

                        Toggle::make('site_active')
                            ->label('Site Active'),
                    ]),

                // Section 2: Appearance
                Section::make('Appearance')
                    ->description('Customize your site look and feel')
                    ->schema([
                        Select::make('default_language')
                            ->label('Default Language')
                            ->options([
                                'en' => 'English',
                                'ar' => 'Arabic',
                            ])
                            ->default('en'),
                    ]),

                // Section 3: Advanced Settings
                Section::make('Advanced Settings')
                    ->description('Timezone and other advanced configurations')
                    ->schema([
                        Select::make('timezone')
                            ->label('Timezone')
                            ->options([
                                'Africa/Cairo' => 'Africa/Cairo',
                                'UTC' => 'UTC',
                                'America/New_York' => 'America/New_York',
                                'Europe/London' => 'Europe/London',
                                // add more timezones as needed
                            ])
                            ->default('Africa/Cairo'),
                    ]),

            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $settings = app(GeneralSettings::class);

        $settings->site_name = $data['site_name'];
        $settings->phone = $data['phone'];
        $settings->site_email = $data['site_email'];
        $settings->site_active = $data['site_active'];
        $settings->default_language = $data['default_language'];
        $settings->timezone = $data['timezone'];

        $settings->save();
    }


    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super admin') ?? false;
    }

    public static function getNavigationLabel(): string
    {
        return __('message.general_settings');
    }

    public static function getPluralLabel(): string
    {
        return __('message.general_settings');
    }

    public function getHeading(): string
    {
        return __('message.general_settings');
    }

    public function getTitle(): string|Htmlable
    {
        return __('message.general_settings');
    }
}
