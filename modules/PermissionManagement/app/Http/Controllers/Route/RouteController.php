<?php

namespace Modules\PermissionManagement\app\Http\Controllers\Route;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Modules\PermissionManagement\app\Http\Requests\Route\StoreRouteRequest;
use Modules\PermissionManagement\app\Models\Route;
use Modules\PermissionManagement\app\Services\RouteService;
use Spatie\Permission\Models\Permission;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $routes = Route::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('route', 'like', '%'.$request->search.'%')
                    ->orWhere('permission_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('route')
            ->paginate(10);
        $facadesRoutes = FacadesRoute::getRoutes();
        $permissions = Permission::orderBy('name')->get();

        return view('permissionmanagement::route.index', compact('routes', 'permissions', 'facadesRoutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('permissionmanagement::route.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(StoreRouteRequest $request, RouteService $routeService)
    {
        return $routeService->create($request)
            ? back()->with('success', 'Route has been created successfully!')
            : back()->with('failed', 'Route was not created successfully!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('permissionmanagement::route.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('permissionmanagement::route.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(StoreRouteRequest $request, Route $route, RouteService $routeService)
    {
        return $routeService->update($request, $route)
            ? back()->with('success', 'Route has been updated successfully!')
            : back()->with('failed', 'Route was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(Route $route)
    {
        return $route->delete()
            ? back()->with('success', 'Route has been deleted successfully!')
            : back()->with('failed', 'Route was not deleted successfully!');
    }
}
