<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
{
    // ovo proverava da li korisnik ima odgovarajuću ulogu
    if (!$request->user() || $request->user()->role !== $role) {
        return response()->json(['message' => 'Nemate dozvolu za ovu akciju.'], 403);
    }

    return $next($request);
}
}
