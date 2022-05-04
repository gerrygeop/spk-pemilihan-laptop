<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KriteriaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kode' => 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'required|string',
            'bobot' => 'required|numeric',
            'type_inputan' => 'required|string',
        ];
    }
}
