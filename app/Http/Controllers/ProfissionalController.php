<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreProfissionalRequest, UpdateProfissionalRequest};
use App\Models\Profissional;

class ProfissionalController extends Controller
{
    public function index(){ return Profissional::query()->latest()->paginate(20); }

    public function store(StoreProfissionalRequest $r){
        $data = $r->validated();
        $prof = Profissional::create($data);
        return response()->json($prof, 201);
    }

    public function show(Profissional $profissional){ return $profissional; }

    public function update(UpdateProfissionalRequest $r, Profissional $profissional){
        $data = $r->validated();
        $profissional->update($data);
        return $profissional;
    }

    public function destroy(Profissional $profissional){
        $profissional->delete();
        return response()->noContent();
    }
}


