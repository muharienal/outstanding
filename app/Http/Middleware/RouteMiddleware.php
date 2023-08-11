<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Modules\PermissionManagement\app\Models\Route;

class RouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routes = Route::firstWhere('route', $request->route()?->getName());

        return blank($routes) || (bool) $routes->status && $request->user()?->can($routes->permission_name)
            ? $next($request)
            : redirect(RouteServiceProvider::HOME)->with('failed', 'you do not have access to this route!');
    }
}
