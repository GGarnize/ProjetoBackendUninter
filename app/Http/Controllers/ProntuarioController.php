<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProntuarioRequest;
use App\Models\Prontuario;
use Illuminate\Http\Request;

class ProntuarioController extends Controller
{
    public function store(StoreProntuarioRequest $r){
        abort_unless($r->user()->role === 'MEDICO', 403);
        $v = $r->validated();
        $prontuario = Prontuario::create($v + ['autor_id'=>$r->user()->id]);
        return response()->json($prontuario, 201);
    }
    public function porPaciente(Request $request, int $id){
        abort_unless($request->user()->role === 'MEDICO', 403);
        return Prontuario::where('paciente_id', $id)
            ->where('autor_id', $request->user()->id)
            ->latest()
            ->get();
    }
    public function index(Request $request){
        abort_unless($request->user()->role === 'MEDICO', 403);
        return Prontuario::where('autor_id', $request->user()->id)
            ->latest()
            ->paginate(20);
    }
    public function show(Request $request, Prontuario $prontuario){
        if ($request->user()->role !== 'MEDICO' || $prontuario->autor_id !== $request->user()->id) {
            abort(404);
        }
        return $prontuario;
    }
}


