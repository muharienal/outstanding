<?php

namespace Modules\Infrastructure\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInfrastructureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'revisi'        => ['required', 'string'],
            'nama_draw' => ['required', 'string'],
            // 'no_draw'       => ['required', 'string'],
            'unit' => ['required', 'string'],
            'user_id' => ['required', 'string'],
            'pic' => ['required', 'string'],
            'progress' => ['required', 'string'],
            'drafter' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
            'file_pdf' => ['required', 'file'],
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
