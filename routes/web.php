<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
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

Route::post('/leads', [LeadController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('leads.store');

Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim(url('/'), '/');
    $lastmod = now()->toAtomString();

    $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <url>
        <loc>{$baseUrl}/</loc>
        <xhtml:link rel="alternate" hreflang="id" href="{$baseUrl}/?lang=id" />
        <xhtml:link rel="alternate" hreflang="en" href="{$baseUrl}/?lang=en" />
        <lastmod>{$lastmod}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
</urlset>
XML;

    return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');