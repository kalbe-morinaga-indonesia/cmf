<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisiRequest extends FormRequest
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
            'txtIdDivisi' => [
                'required',
                'max:8',
                'unique:divisis,txtIdDivisi,' .$this->divisi->id,
            ],
            'txtNamaDivisi' => [
                'required',
            ]
        ];
    }

    public function messages()
    {
        return [
            'txtIdDivisi.required' => 'Id divisi wajib diisi',
            'txtIdDivisi.max' => 'Id Divisi maksimal 8 karakter',
            'txtIdDivisi.unique' => 'Id divisi sudah digunakan',
            'txtNamaDivisi.required' => 'Nama divisi wajib diisi'
        ];
    }
}
