<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Helper;

class ApiLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check header request and determine localizaton
        $local = $request->header('language') != "" ? $request->header('language') : config('app.locale');

        // set laravel localization
        app()->setLocale($local);

        $languages = Helper::getLanguage(['code' => $local]);
        $request->merge([ 'language' => $languages ]);

        // continue request
        return $next($request);
    }
}
