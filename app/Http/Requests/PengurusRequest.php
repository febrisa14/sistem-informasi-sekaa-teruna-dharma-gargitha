<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengurusRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'name' => 'required',
            'no_telp' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'pengurus_jabatan_id' => 'required',
            'alamat' => 'required'
        ];
    }
}
