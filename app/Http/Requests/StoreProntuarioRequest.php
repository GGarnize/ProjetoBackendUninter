<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProntuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
          'paciente_id'=>'required|exists:pacientes,id',
          'texto'=>'required|string',
          'anexos'=>'nullable|array'
        ];
    }
}


