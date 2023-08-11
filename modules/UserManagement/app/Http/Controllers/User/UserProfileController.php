<?php

namespace Modules\UserManagement\app\Http\Controllers\User;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('usermanagement::profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('usermanagement::profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('usermanagement::profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('usermanagement::profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function update(Request $request, User $profile)
    {
        if ($request->hasFile('avatar') and ! blank($request->avatar)) {
            $name = str()->uuid()->toString().'.'.$request->file('avatar')->extension();

            $request->file('avatar')->move(public_path('assets/user/image'), $name);

            $profile->update(['avatar' => $name]);
        }

        $profile->update($request->only('name', 'nik', 'jabatan', 'area', 'phone', 'alamat'));

        return back()->with('success', 'Profile has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
