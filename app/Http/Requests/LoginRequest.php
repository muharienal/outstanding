<?php

namespace App\Http\Requests;

use App\Models\User;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as RequestsLoginRequest;

class LoginRequest extends RequestsLoginRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            Fortify::username() => 'nullable|string',
            'password' => 'nullable|string',
            'nik' => 'nullable|string',
        ];
    }

    //handle status 0 then redirect to login and show message withValidator
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = User::where('nik', $this->nik)->first();
            if ($user) {
                if ($user->status == 0) {
                    $validator->errors()->add('nik', 'Your account is not active, please contact the administrator');
                }
            }
        });
    }
}
