<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Preference; // Cambiado a Preference en lugar de Preferences

class PreferenceFactory extends Factory // Cambiado a PreferenceFactory en lugar de PreferencesFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['mujer', 'hombre', 'no binario']),
            'looksFor' => $this->faker->randomElement(['mujer', 'hombre', 'no binario', 'todo']),
            'ageRange' => $this->faker->randomElement(['20-30', '25-35', '35-45', 'no importa']),
            'sexoAffective' => $this->faker->randomElement(['monogama', 'explorar', 'abierta', 'beneficios', 'fluir', 'casual']),
            'heartState' => $this->faker->randomElement(['maduro', 'solo', 'feliz', 'recuperarse', 'despechado']),
            'hasChildren' => $this->faker->randomElement(['si', 'no']),
            'datesParents' => $this->faker->randomElement(['si', 'no','no sabe']),
            'values1' => $this->faker->randomElement(['amabilidad', 'amistad', 'autenticidad', 'aventura', 'comunicacion', 'conciencia', 'confianza', 'creatividad', 'cuidado', 'desarrollo']),
            'values2' => $this->faker->randomElement(['diversion', 'empatia', 'familia', 'fidelidad', 'generosidad', 'gratitud', 'honestidad', 'humildad', 'integridad', 'inteligencia']),
            'values3' => $this->faker->randomElement(['lealtad', 'libertad', 'optimismo', 'resiliencia', 'respeto', 'responsabilidad', 'afectiva', 'sencillez', 'solidaridad', 'humor', 'valentia']),
            'prefers1' => $this->faker->randomElement(['netflix', 'eventos', 'gym', 'resiliencia', 'todas']),
            'prefers2' => $this->faker->randomElement(['vino', 'cafe', 'agua', 'segun', 'ninguna']),
            'catsDogs' => $this->faker->randomElement(['gato', 'perro', 'de amigos']),
            'rrss' => $this->faker->regexify('[A-Za-z0-9]{7}'),
        ];
    }
}
