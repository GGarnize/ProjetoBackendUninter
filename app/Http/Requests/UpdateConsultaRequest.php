<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
          'paciente_id'=>'sometimes|exists:pacientes,id',
          'profissional_id'=>'sometimes|exists:profissionais,id',
          'inicio'=>'sometimes|date|required_with:fim',
          'fim'=>'sometimes|date|after:inicio|required_with:inicio'
        ];
    }
}


