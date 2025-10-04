<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PacienteTest extends TestCase
{
    private function authToken(): string
    {
        $user = User::factory()->create(['role'=>'ATENDENTE']);
        return $user->createToken('api')->plainTextToken;
    }

    public function test_crud_paciente_with_cpf_hashing(): void
    {
        $token = $this->authToken();
        $headers = ['Authorization' => 'Bearer '.$token];

        $create = $this->withHeaders($headers)->postJson('/api/pacientes', [
            'nome' => 'Fulano',
            'cpf' => '00000000000',
            'data_nasc' => '1990-01-01',
            'contato' => '11999999999',
        ]);
        $create->assertStatus(201);
        $id = $create->json('id');

        $list = $this->withHeaders($headers)->getJson('/api/pacientes');
        $list->assertOk();

        $show = $this->withHeaders($headers)->getJson('/api/pacientes/'.$id);
        $show->assertOk()->assertJsonMissing(['cpf' => '00000000000']);

        $update = $this->withHeaders($headers)->putJson('/api/pacientes/'.$id, ['nome'=>'Atual']);
        $update->assertOk()->assertJsonFragment(['nome'=>'Atual']);

        $del = $this->withHeaders($headers)->deleteJson('/api/pacientes/'.$id);
        $del->assertNoContent();
    }
}


