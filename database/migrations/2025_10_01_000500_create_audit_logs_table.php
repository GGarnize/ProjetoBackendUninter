<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $t->string('method',10);
            $t->string('route');
            $t->ipAddress('ip')->nullable();
            $t->char('payload_hash',64)->nullable();
            $t->timestamps();
            $t->index(['user_id','route']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};


