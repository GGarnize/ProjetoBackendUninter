<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $t) {
            $t->id();
            $t->foreignId('paciente_id')->constrained('pacientes')->cascadeOnDelete();
            $t->foreignId('profissional_id')->constrained('profissionais')->cascadeOnDelete();
            $t->dateTime('inicio');
            $t->dateTime('fim');
            $t->enum('status', ['AGENDADA','REALIZADA','CANCELADA'])->default('AGENDADA');
            $t->timestamps();
            $t->index(['profissional_id','inicio','fim']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};


