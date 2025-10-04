<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id','profissional_id','inicio','fim','status'];

    public function paciente()
    {
        return $this->belongsTo(\App\Models\Paciente::class);
    }

    public function profissional()
    {
        return $this->belongsTo(\App\Models\Profissional::class);
    }
}


