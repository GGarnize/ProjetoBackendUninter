<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Profissional>
 */
class ProfissionalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'conselho' => fake()->optional()->bothify('CRM ####'),
            'especialidade' => fake()->optional()->randomElement(['Clínico Geral','Cardiologia','Pediatria']),
        ];
    }
}


