<?php

namespace Modules\MenuManagement\app\Http\Requests\MenuGroup;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuGroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'permission_name' => ['required', 'string'],
            'status' => ['nullable', 'required', 'boolean'],
            'posision' => ['nullable', 'numeric'],
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
