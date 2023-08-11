<?php

namespace Modules\Infrastructure\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfrastructureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'revisi' => ['nullable', 'string'],
            'keterangan' => ['nullable', 'string'],
            'progress' => ['nullable', 'string'],
            'drafter' => ['nullable', 'string'],
            'file_pdf' => ['nullable', 'file'],
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
