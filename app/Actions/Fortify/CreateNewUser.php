<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Modules\Setting\app\Models\Setting;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'unit_kerja' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->validate();

        $role = json_decode(Setting::first()->data)->role;

        return User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'unit_kerja' => $input['unit_kerja'],
            'password' => Hash::make($input['password']),
        ])?->assignRole($role);
    }
}
