<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prontuarios', function (Blueprint $t) {
            $t->id();
            $t->foreignId('paciente_id')->constrained('pacientes')->cascadeOnDelete();
            $t->foreignId('autor_id')->constrained('users')->cascadeOnDelete();
            $t->longText('texto');
            $t->json('anexos')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prontuarios');
    }
};


