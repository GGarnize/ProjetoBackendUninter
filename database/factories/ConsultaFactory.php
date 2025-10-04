<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Consulta>
 */
class ConsultaFactory extends Factory
{
    public function definition(): array
    {
        $inicio = fake()->dateTimeBetween('+1 day', '+2 days');
        $fim = (clone $inicio)->modify('+1 hour');
        return [
            'paciente_id' => \App\Models\Paciente::factory(),
            'profissional_id' => \App\Models\Profissional::factory(),
            'inicio' => $inicio,
            'fim' => $fim,
            'status' => 'AGENDADA',
        ];
    }
}


