<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class testmiddleware
{
  
    public function handle(Request $request, Closure $next)
    {

        if ($request-> num > 3) {

             return redirect('api/month/1');
        }
        return $next($request);
    }
}
