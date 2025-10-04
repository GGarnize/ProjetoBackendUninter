<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StorePacienteRequest,UpdatePacienteRequest};
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function index(){ return Paciente::query()->latest()->paginate(20); }

    public function store(StorePacienteRequest $r){
        $v = $r->validated();
        $hash = hash('sha256', $v['cpf'].config('app.key'));
        $paciente = Paciente::create([
            'nome'=>$v['nome'],
            'cpf_hash'=>$hash,
            'data_nasc'=>$v['data_nasc'] ?? null,
            'contato'=>$v['contato'] ?? null
        ]);
        return response()->json($paciente, 201);
    }

    public function show(Paciente $paciente){ return $paciente; }

    public function update(UpdatePacienteRequest $r, Paciente $paciente){
        $data = $r->validated();
        if(isset($data['cpf'])){
            $data['cpf_hash'] = hash('sha256', $data['cpf'].config('app.key'));
            unset($data['cpf']);
        }
        $paciente->update($data);
        return $paciente;
    }

    public function destroy(Paciente $paciente){
        $paciente->delete();
        return response()->noContent();
    }
}


