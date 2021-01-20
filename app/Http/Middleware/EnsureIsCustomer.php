<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->isCustomer) {
            return $next($request);
        }
        else{
            return redirect('home');
        }
    }
}
