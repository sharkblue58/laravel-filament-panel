<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Http;

class JokeOfTheDay extends Widget
{
    protected string $view = 'filament.widgets.joke-of-the-day';

    protected int | string | array $columnSpan = 'full';

    public $joke = '';
    public function mount(): void
    {
        $response = Http::get('https://official-joke-api.appspot.com/random_joke');

        if ($response->ok()) {
            $data = $response->json();
            $this->joke = $data['setup'] . ' — ' . $data['punchline'];
        } else {
            $this->joke = 'Could not fetch a joke today 😢';
        }
    }
}
