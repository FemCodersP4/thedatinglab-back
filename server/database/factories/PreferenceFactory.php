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
            'looksFor' => $this->faker->randomElement(['mujeres', 'hombres', 'no binarias', 'todo']),
            'ageRange' => $this->faker->randomElement(['20-30', '25-35', '35-45', 'no importa']),
            'sexoAffective' => $this->faker->randomElement(['monogama', 'explorar', 'abierta', 'beneficios', 'fluir', 'casual']),
            'heartState' => $this->faker->randomElement(['maduro', 'solo', 'feliz', 'recuperarse', 'despechado']),
            'values1' => $this->faker->randomElement(['honestidad', 'respeto', 'responsabilidad', 'empatia', 'integridad', 'gratitud', 'generosidad', 'tolerancia', 'solidaridad', 'humildad', 'perseverancia', 'justicia']),
            'values2' => $this->faker->randomElement(['honestidad', 'respeto', 'responsabilidad', 'empatia', 'integridad', 'gratitud', 'generosidad', 'tolerancia', 'solidaridad', 'humildad', 'perseverancia', 'justicia']),
            'values3' => $this->faker->randomElement(['honestidad', 'respeto', 'responsabilidad', 'empatia', 'integridad', 'gratitud', 'generosidad', 'tolerancia', 'solidaridad', 'humildad', 'perseverancia', 'justicia']),
            'preferences1' => $this->faker->randomElement(['netflix', 'eventos', 'gym', 'escapadas', 'todas']),
            'preferences2' => $this->faker->randomElement(['alcohol', 'cafe', 'agua', 'ninguna', 'no alcohol']),
            'catsDogs' => $this->faker->randomElement(['gatos', 'perros', 'todos', 'no gustan']),
        ];
    }
}