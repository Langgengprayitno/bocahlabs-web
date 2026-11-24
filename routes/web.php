<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/lang/{locale}', function (Request $request, string $locale): RedirectResponse {
    if (! in_array($locale, ['id', 'en'], true)) {
        $locale = 'id';
    }

    $request->session()->put('locale', $locale);

    return redirect()
        ->back()
        ->withCookie(cookie('bocahlabs_lang', $locale, 60 * 24 * 365));
})->name('lang.switch');