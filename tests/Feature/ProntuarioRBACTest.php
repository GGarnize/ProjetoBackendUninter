<?php

namespace Tests\Feature;

use App\Models\{User,Paciente};
use Tests\TestCase;

class ProntuarioRBACTest extends TestCase
{
    private function tokenFor(string $role): string
    {
        $user = User::factory()->create(['role'=>$role]);
        return $user->createToken('api')->plainTextToken;
    }

    public function test_medico_can_create_201(): void
    {
        $pac = \App\Models\Paciente::factory()->create();
        $token = $this->tokenFor('MEDICO');
        $res = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/prontuarios', [
                'paciente_id' => $pac->id,
                'texto' => 'Nota',
                'anexos' => [],
            ]);
        $res->assertStatus(201);
    }

    public function test_atendente_forbidden_403(): void
    {
        $pac = \App\Models\Paciente::factory()->create();
        $token = $this->tokenFor('ATENDENTE');
        $res = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/prontuarios', [
                'paciente_id' => $pac->id,
                'texto' => 'Nota',
                'anexos' => [],
            ]);
        $res->assertStatus(403);
    }
}


