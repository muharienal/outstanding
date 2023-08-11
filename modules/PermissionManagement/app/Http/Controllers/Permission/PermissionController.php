<?php

namespace Modules\PermissionManagement\app\Http\Controllers\Permission;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PermissionManagement\app\Http\Requests\Permission\StorePermissionRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $permissions = Permission::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('guard_name', 'like', '%'.$request->search.'%');
            })
            ->with('roles', function ($query) {
                return $query->select('id', 'name');
            })
            ->orderBy('name')
            ->paginate(10);
        $roles = Role::orderBy('name')->get();

        return view('permissionmanagement::permission.index', compact('permissions', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('permissionmanagement::permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(StorePermissionRequest $request)
    {
        return Permission::create($request->validated())
            ?->assignRole(! blank($request->roles) ? $request->roles : [])
            ? back()->with('success', 'Permission has been created successfully!')
            : back()->with('failed', 'Permission was not created successfully!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('permissionmanagement::permission.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('permissionmanagement::permission.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(StorePermissionRequest $request, Permission $permission)
    {
        return $permission->update($request->validated())
            && $permission->syncRoles(! blank($request->roles) ? $request->roles : [])
            ? back()->with('success', 'Permission has been updated successfully!')
            : back()->with('failed', 'Permission was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(Permission $permission)
    {
        return $permission->delete()
            ? back()->with('success', 'Permission has been deleted successfully!')
            : back()->with('failed', 'Permission was not deleted successfully!');
    }
}
