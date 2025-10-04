<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $t) {
            $t->id();
            $t->string('nome',120);
            $t->char('cpf_hash',64);
            $t->date('data_nasc')->nullable();
            $t->string('contato',120)->nullable();
            $t->timestamps();
            $t->index('cpf_hash');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};


