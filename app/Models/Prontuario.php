<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id','autor_id','texto','anexos'];

    protected $casts = ['anexos' => 'array'];

    public function paciente()
    {
        return $this->belongsTo(\App\Models\Paciente::class);
    }

    public function autor()
    {
        return $this->belongsTo(\App\Models\User::class, 'autor_id');
    }
}


