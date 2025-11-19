<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\URL;
use Closure;

class SetDefaultLocaleForUrls
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
        URL::defaults(['locale' => ($request->locale != ''?$request->locale:'nl')]);

        return $next($request);
    }
}