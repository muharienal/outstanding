<?php

namespace Modules\PermissionManagement\app\Services;

use Illuminate\Http\Request;
use Modules\PermissionManagement\app\Models\Route;

class RouteService
{
    public function create(Request $request): Route
    {
        return Route::create(array_merge(
            $request->validated(),
            ['status' => ! blank($request->status) ? true : false]
        ));
    }

    public function update(Request $request, Route $route): Route|bool
    {
        return $route->update(array_merge(
            $request->validated(),
            ['status' => ! blank($request->status) ? true : false]
        ));
    }
}
