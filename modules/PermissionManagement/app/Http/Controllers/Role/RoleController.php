<?php

namespace Modules\PermissionManagement\app\Http\Controllers\Role;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PermissionManagement\app\Http\Requests\Role\StoreRoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $roles = Role::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('guard_name', 'like', '%'.$request->search.'%');
            })
            ->with('permissions', function ($query) {
                return $query->select('id', 'name');
            })
            ->orderBy('name')
            ->paginate(10);
        $permissions = Permission::orderBy('name')->get();

        return view('permissionmanagement::role.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('permissionmanagement::role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(StoreRoleRequest $request)
    {
        return Role::create($request->validated())
            ?->givePermissionTo(! blank($request->permissions) ? $request->permissions : [])
            ? back()->with('success', 'Role has been created successfully!')
            : back()->with('failed', 'Role was not created successfully!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('permissionmanagement::role.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('permissionmanagement::role.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        return $role->update($request->validated())
            && $role->syncPermissions(! blank($request->permissions) ? $request->permissions : [])
            ? back()->with('success', 'Role has been updated successfully!')
            : back()->with('failed', 'Role was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(Role $role)
    {
        return $role->delete()
            ? back()->with('success', 'Role has been deleted successfully!')
            : back()->with('failed', 'Role was not deleted successfully!');
    }
}
