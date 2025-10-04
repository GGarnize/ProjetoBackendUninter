<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProntuarioRequest;
use App\Models\Prontuario;

class ProntuarioController extends Controller
{
    public function store(StoreProntuarioRequest $r){
        abort_unless($r->user()->role === 'MEDICO', 403);
        $v = $r->validated();
        $prontuario = Prontuario::create($v + ['autor_id'=>$r->user()->id]);
        return response()->json($prontuario, 201);
    }
    public function porPaciente(int $id){
        return Prontuario::where('paciente_id',$id)->latest()->get();
    }
    public function index(){ return Prontuario::latest()->paginate(20); }
    public function show(Prontuario $prontuario){ return $prontuario; }
}


