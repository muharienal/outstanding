<?php

namespace Modules\MenuManagement\app\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\MenuManagement\app\Http\Requests\MenuItem\StoreMenuitemRequest;
use Modules\MenuManagement\app\Models\MenuGroup;
use Modules\MenuManagement\app\Models\MenuItem;
use Modules\MenuManagement\app\Services\MenuItemService;
use Spatie\Permission\Models\Permission;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request, MenuGroup $menu)
    {
        $menuItems = $menu->items()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('permission_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('name')
            ->paginate(10);
        $permissions = Permission::orderBy('name')->get();
        $routes = Route::getRoutes();

        return view('menumanagement::menu.item.index', compact('menu', 'menuItems', 'permissions', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('menumanagement::menu.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(StoreMenuitemRequest $request, MenuGroup $menu, MenuItemService $menuItemService)
    {
        return $menuItemService->create($request, $menu)
            ? back()->with('success', 'Menu item has been created successfully!')
            : back()->with('failed', 'Menu item was not created successfully!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('menumanagement::menu.item.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('menumanagement::menu.item.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(StoreMenuitemRequest $request, MenuGroup $menu, MenuItem $item, MenuItemService $menuItemService)
    {
        return $menuItemService->update($request, $menu, $item)
            ? back()->with('success', 'Menu item has been updated successfully!')
            : back()->with('failed', 'Menu item was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(MenuGroup $menu, MenuItem $item)
    {
        return $item->delete()
            ? back()->with('success', 'Menu item has been deleted successfully!')
            : back()->with('failed', 'Menu item was not deleted successfully!');
    }
}
