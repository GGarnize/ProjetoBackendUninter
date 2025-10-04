<?php

namespace Tests\Feature;

use App\Models\{User,Paciente,Profissional,Consulta};
use Tests\TestCase;

class ConsultaConflictTest extends TestCase
{
    private function authToken(): string
    {
        $user = User::factory()->create(['role'=>'ATENDENTE']);
        return $user->createToken('api')->plainTextToken;
    }

    public function test_conflict_returns_409(): void
    {
        $token = $this->authToken();
        $headers = ['Authorization' => 'Bearer '.$token];

        $pac = Paciente::factory()->create();
        $pro = Profissional::factory()->create();

        $first = $this->withHeaders($headers)->postJson('/api/consultas', [
            'paciente_id' => $pac->id,
            'profissional_id' => $pro->id,
            'inicio' => '2025-10-01T10:00:00',
            'fim' => '2025-10-01T11:00:00',
        ]);
        $first->assertStatus(201);

        $conflict = $this->withHeaders($headers)->postJson('/api/consultas', [
            'paciente_id' => $pac->id,
            'profissional_id' => $pro->id,
            'inicio' => '2025-10-01T10:30:00',
            'fim' => '2025-10-01T11:30:00',
        ]);
        $conflict->assertStatus(409);
    }
}


