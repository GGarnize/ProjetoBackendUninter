<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
          'nome'=>'sometimes|string',
          'cpf'=>'sometimes|string',
          'data_nasc'=>'nullable|date',
          'contato'=>'nullable|string'
        ];
    }
}


