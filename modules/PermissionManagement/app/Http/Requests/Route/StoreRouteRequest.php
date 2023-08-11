<?php

namespace Modules\PermissionManagement\app\Http\Requests\Route;

use Illuminate\Foundation\Http\FormRequest;

class StoreRouteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'route' => ['required', 'string'],
            'permission_name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
