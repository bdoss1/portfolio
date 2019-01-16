<?php

namespace App\Http\Middleware;

use Closure;

class LocaleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \App::setLocale(\CustomLocale::getCurrentLocale());
        return $next($request);
    }
}
