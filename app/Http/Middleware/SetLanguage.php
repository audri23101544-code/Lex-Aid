<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale', 'en');

        if (in_array($locale, ['en', 'bn'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}