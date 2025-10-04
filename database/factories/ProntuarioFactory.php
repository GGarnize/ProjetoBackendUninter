<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Prontuario>
 */
class ProntuarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'paciente_id' => \App\Models\Paciente::factory(),
            'autor_id' => \App\Models\User::factory(),
            'texto' => fake()->paragraph(),
            'anexos' => [],
        ];
    }
}


