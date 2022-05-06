<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepresentasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'keterangan' => 'required|string',
            'min' => 'nullable|string',
            'max' => 'nullable',
            'nilai' => 'nullable',
        ];
    }
}
