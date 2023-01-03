<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
            'txtIdDept' => [
                'required',
                Rule::unique('departments')->ignore($this->department)
            ],
            'txtNamaDept' => [
                'required'
            ],
            'divisi_id' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return[
            'txtIdDept.required' => 'Id Department wajib diisi',
            'txtIdDept.unique' => 'Id department sudah digunakan',
            'txtNamaDept.required' => 'Nama department wajib diisi',
            'divisi_id.required' => 'Divisi wajib diisi'
        ];
    }
}
