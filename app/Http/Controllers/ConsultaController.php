<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreConsultaRequest,UpdateConsultaRequest};
use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index(Request $r){
        $q = Consulta::query();
        if ($r->profissional_id) $q->where('profissional_id',$r->profissional_id);
        if ($r->dia) $q->whereDate('inicio',$r->dia);
        return $q->latest('inicio')->paginate(20);
    }

    public function store(StoreConsultaRequest $r){
        $v = $r->validated();
        $conflito = Consulta::where('profissional_id',$v['profissional_id'])
          ->where('status','!=','CANCELADA')
          ->where(function($w) use ($v){
            $w->where('inicio','<',$v['fim'])->where('fim','>',$v['inicio']);
          })->exists();
        if ($conflito) return response()->json(['message'=>'Conflito de agenda'], 409);
        $consulta = Consulta::create($v);
        return response()->json($consulta, 201);
    }

    public function update(UpdateConsultaRequest $r, Consulta $consulta){
        $v = $r->validated();
        $proId = $v['profissional_id'] ?? $consulta->profissional_id;
        $inicio = $v['inicio'] ?? $consulta->inicio;
        $fim    = $v['fim'] ?? $consulta->fim;
        $conflito = Consulta::where('profissional_id',$proId)
          ->where('id','!=',$consulta->id)
          ->where('status','!=','CANCELADA')
          ->where(function($w) use ($inicio,$fim){
            $w->where('inicio','<',$fim)->where('fim','>',$inicio);
          })->exists();
        if ($conflito) return response()->json(['message'=>'Conflito de agenda'], 409);
        $consulta->update($v);
        return $consulta;
    }

    public function destroy(Consulta $consulta){ $consulta->delete(); return response()->noContent(); }
    public function show(Consulta $consulta){ return $consulta; }
}


