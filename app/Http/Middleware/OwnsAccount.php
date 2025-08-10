<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnsAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeId = $request->route('user') ?? $request->route('id');

        if ((int) Auth::id() == (int) $routeId OR Auth::user()->role == 'admin') {
            return $next($request);
        }
        
        return redirect()->route('movie.index')->with('warning', 'Ação não permitida.');
    }
}
