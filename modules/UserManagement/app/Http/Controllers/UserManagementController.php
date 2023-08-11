<?php

namespace Modules\UserManagement\app\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagement\app\Http\Requests\StoreUserRequest;
use Modules\UserManagement\app\Http\Requests\UpdateUserRequest;
use Modules\UserManagement\app\Services\UserService;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            })
            ->with('roles', function ($query) {
                return $query->select('name');
            })
            ->latest()
            ->paginate(10);

        $roles = Role::orderBy('name')->get();

        return view('usermanagement::user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('usermanagement::user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(StoreUserRequest $request, UserService $userService)
    {
        return $userService->create($request)
            ? back()->with('success', 'User has been created successfully!')
            : back()->with('failed', 'User was not created successfully!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('usermanagement::user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('usermanagement::user.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(UpdateUserRequest $request, User $user, UserService $userService)
    {
        return $userService->update($request, $user)
            ? back()->with('success', 'User has been updated successfully!')
            : back()->with('failed', 'User was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(User $user)
    {
        return $user->delete()
            ? back()->with('success', 'User has been deleted successfully!')
            : back()->with('failed', 'User was not deleted successfully!');
    }
}
