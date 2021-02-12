<?php

namespace App\Http\Middleware;

use App\Models\Redirect as ModelsRedirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;

class Redirect
{
    public function handle(Request $request, Closure $next)
    {
        $base_url = Config::get('app.url');
        $redirect = ModelsRedirect::where('from','=',$base_url.$request->getRequestUri())->first();
        if(isset($redirect)){
            return FacadesRedirect::to($redirect->to, $redirect->type);
        }
        return $next($request);
    }
}
