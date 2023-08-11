<?php

namespace Modules\MenuManagement\app\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuitemRequest extends FormRequest
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
            'route' => ['required', 'string'],
            'permission_name' => ['required', 'string'],
            'icon' => ['sometimes', 'required', 'string', 'starts_with:fas fa'],
            'status' => ['sometimes', 'required', 'boolean'],
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
