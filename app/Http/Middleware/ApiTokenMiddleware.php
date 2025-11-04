<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $token = $request-> header('X-API-TOKEN');

        $validToken = env ('API_TOKEN');

        if ($token !== $validToken) {


            return response()->json([
                'success' => false,
                'message' => 'Invalid missing API Token'
            ],401);
        }
        return $next($request);
    }
}
