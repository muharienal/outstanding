<?php

namespace Modules\Report\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tanggal_input'         => ['nullable', 'string'],
            'tanggal_mulai'         => ['nullable', 'string'],
            'show_status'           => ['nullable', 'string'],
            'unit'                  => ['nullable', 'string'],
            'equipment'             => ['nullable', 'string'],
            'program_kerja'         => ['nullable', 'string'],
            'keterangan_pekerjaan'  => ['nullable', 'string'],
            'status_pekerjaan'      => ['nullable', 'string'],
            'progress'              => ['nullable', 'string'],
            'target'                => ['nullable', 'string'],
            'wo_number'             => ['nullable', 'string'],
            'keterangan'            => ['nullable', 'string'],
            'scope_1'               => ['nullable', 'string'],
            'scope_2'               => ['nullable', 'string'],
            'pic'                   => ['nullable', 'string'],
            'prioritas'             => ['nullable', 'string'],
            'upload_foto.*'         => ['nullable', 'file'],
            'upload_document.*'     => ['nullable', 'file'],
            
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
