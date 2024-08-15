<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-API-Token');

        if ($token !== config('app.api_token')) {
            return response()->json(['error' => 'Acceso no autorizado'], 401);
        }

        return $next($request);
    }
}