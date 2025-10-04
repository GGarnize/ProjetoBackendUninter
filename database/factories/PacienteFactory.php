<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    public function definition(): array
    {
        $cpf = (string) fake()->randomNumber(9) . fake()->randomNumber(2);
        return [
            'nome' => fake()->name(),
            'cpf_hash' => hash('sha256', $cpf.config('app.key')),
            'data_nasc' => fake()->optional()->date(),
            'contato' => fake()->optional()->phoneNumber(),
        ];
    }
}


