<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
          'paciente_id'=>'required|exists:pacientes,id',
          'profissional_id'=>'required|exists:profissionais,id',
          'inicio'=>'required|date',
          'fim'=>'required|date|after:inicio'
        ];
    }
}


