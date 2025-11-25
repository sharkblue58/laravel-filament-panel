<x-filament-panels::page>
    <x-filament::card>
        <form wire:submit.prevent="create">
            <div style="margin-bottom: 3rem">
                {{ $this->form }}
            </div>
            <div class="mt-4">
                <x-filament::button type="submit">
                    Save Settings
                </x-filament::button>
            </div>
        </form>
    </x-filament::card>
</x-filament-panels::page>
