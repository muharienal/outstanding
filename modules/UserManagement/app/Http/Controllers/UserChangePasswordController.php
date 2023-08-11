<?php

namespace Modules\UserManagement\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\UserManagement\app\Http\Requests\UserChangePasswordRequest;

class UserChangePasswordController extends Controller
{
    public function __invoke(UserChangePasswordRequest $request)
    {
        $status = $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return $status
            ? back()->with('success', 'Password has been updated successfully!')
            : back()->with('failed', 'Password was not updated successfully!');
    }
}
