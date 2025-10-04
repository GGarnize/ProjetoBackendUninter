<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = ['nome','cpf_hash','data_nasc','contato'];

    public function prontuarios()
    {
        return $this->hasMany(\App\Models\Prontuario::class);
    }
}


