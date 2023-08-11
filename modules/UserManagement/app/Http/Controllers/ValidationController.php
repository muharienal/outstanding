<?php

namespace Modules\UserManagement\app\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagement\app\Http\Requests\ValidationRequest;
use Modules\UserManagement\app\Models\Validation;
use Modules\UserManagement\app\Repositories\ValidationRepository;

class ValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(
        ValidationRepository $validationRepository
    ) {
        if (auth()->user()->hasRole('Super Admin')) {
            $validations = $validationRepository->getAll();

            return view('usermanagement::validation.admin.index', compact('validations'));
        } else {
            return $validationRepository->hasValidate()
                ? to_route('dashboard.index')->with('success', auth()->user()->isValidated() ? 'User already verify!' : 'User will verify soon!')
                : view('usermanagement::validation.user.index');
        }

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('usermanagement::validation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(
        ValidationRequest $request,
        ValidationRepository $validationRepository
    ) {
        return $validationRepository->store($request)
            ? to_route('dashboard.index')->with('success', 'User will verify soon!')
            : to_route('dashboard.index')->with('failed', 'Can not verify user!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('usermanagement::validation.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('usermanagement::validation.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function update(Request $request, Validation $validation)
    {
        return $validation->user()->update([
            'validated_at' => now(),
        ])
            ? back()->with('success', 'User has been verified successfully!')
            : back()->with('failed', 'User was not verified successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(Validation $validation)
    {
        return $validation->user()->delete() && $validation->delete()
            ? back()->with('success', 'User has been deleted successfully!')
            : back()->with('failed', 'User was not deleted successfully!');
    }

    public function approve(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();

        return back()->with('success', 'User has been approved successfully!');
    }
}
