<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_register_login_me_logout_flow(): void
    {
        $payload = [
            'name' => 'Tester',
            'email' => 'tester@local',
            'password' => 'secret123',
            'role' => 'ATENDENTE',
        ];

        $res = $this->postJson('/api/auth/register', $payload);
        $res->assertStatus(201)->assertJsonStructure(['token']);

        $token = $res->json('token');

        $res = $this->postJson('/api/auth/login', ['email'=>$payload['email'],'password'=>$payload['password']]);
        $res->assertOk()->assertJsonStructure(['token']);

        $loginToken = $res->json('token');

        $res = $this->withHeader('Authorization', 'Bearer '.$loginToken)->getJson('/api/me');
        $res->assertOk()->assertJsonFragment(['email'=>$payload['email']]);

        $res = $this->withHeader('Authorization', 'Bearer '.$loginToken)->postJson('/api/auth/logout');
        $res->assertNoContent();
    }
}


