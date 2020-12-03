<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->role=='admin'){
                return $next($request);
            }
            else abort(403);
        }
        else{
            return redirect()->route('login');
        }
    }
}
