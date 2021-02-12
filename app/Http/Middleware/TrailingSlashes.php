<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class TrailingSlashes
{
    public function handle(Request $request, Closure $next)
    {
        if (!preg_match('/.+\/$/', $request->getRequestUri()))
        {
          $base_url = Config::get('app.url');
          return Redirect::to($base_url.$request->getRequestUri().'/');
        }
        return $next($request);
    }
}
