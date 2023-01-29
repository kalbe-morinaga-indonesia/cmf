<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubdepartmentRequest extends FormRequest
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
            'txtIdSubDept' => [
                'required',
                Rule::unique('subdepartments')->ignore($this->subdepartment)
            ],
            'txtNamaSubDept' => [
                'required'
            ],
            'department_id' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return[
            'txtIdSubDept.required' => 'Id subDepartment wajib diisi',
            'txtIdSubDept.unique' => 'Id subdepartment sudah digunakan',
            'txtNamaSubDept.required' => 'Nama subdepartment wajib diisi',
            'department_id.required' => 'Department wajib diisi'
        ];
    }
}
