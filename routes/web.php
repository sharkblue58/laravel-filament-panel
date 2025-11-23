<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/switch-lang/{lang}', function ($lang) {

    if (! in_array($lang, ['en', 'ar'])) {
        abort(404);
    }

    session(['locale' => $lang]);
    app()->setLocale($lang);

    return back();
})->name('switch.lang');
