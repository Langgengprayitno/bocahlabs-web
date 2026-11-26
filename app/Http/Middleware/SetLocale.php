<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $queryLang = $request->query('lang');
        if (is_string($queryLang) && in_array($queryLang, ['id', 'en'], true)) {
            app()->setLocale($queryLang);

            return $next($request);
        }

        $locale = $request->session()->get('locale', $request->cookie('bocahlabs_lang', 'id'));

        if (! in_array($locale, ['id', 'en'], true)) {
            $locale = 'id';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}