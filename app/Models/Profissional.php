<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $fillable = ['nome','conselho','especialidade'];

    public function consultas()
    {
        return $this->hasMany(\App\Models\Consulta::class);
    }
}


