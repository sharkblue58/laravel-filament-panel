<div>
    <x-filament::dropdown maxHeight="250px" placement="left-start" teleport="true">
        <x-slot name="trigger" style="padding-top: 10px; padding-bottom: 10px;">
            <div class="p-2 flex items-center justify-start gap-2">
                <x-filament::icon :icon="app()->getLocale() === 'ar' ? 'heroicon-m-chevron-left' : 'heroicon-m-chevron-right'" class="mx-1 h-5 w-5 text-gray-500 dark:text-gray-400 inline-block"
                    style="display:inline-flex" />

                <span style="font-size: .875rem">{{ __('message.select-lang') }}</span>
            </div>
        </x-slot>

        <x-filament::dropdown.header class="font-semibold" color="gray" icon="heroicon-o-language">
            {{ __('message.select-lang') }}
        </x-filament::dropdown.header>

        <x-filament::dropdown.list>
            <x-filament::dropdown.list.item :color="(app()->getLocale() === 'en') ? 'primary' : null" :icon="app()->getLocale() === 'ar' ? 'heroicon-m-chevron-left' : 'heroicon-m-chevron-right'" :href="url('/switch-lang/en')" tag="a">
                {{ __('message.english') }}
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item :color="(app()->getLocale() === 'ar') ? 'primary' : null" :icon="app()->getLocale() === 'ar' ? 'heroicon-m-chevron-left' : 'heroicon-m-chevron-right'" :href="url('/switch-lang/ar')" tag="a">
                {{ __('message.arabic') }}
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
