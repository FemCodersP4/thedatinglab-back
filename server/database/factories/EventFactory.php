<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'uploads/test1.jpg',
            'date' => $this->faker->date(),
            'time' => $this->faker->time('H:i'),
            'location' => $this->faker->city(), // Genera una ciudad aleatoria
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'shortDescription' => $this->faker->paragraph(),
            'user_id' => '1'
        ];
    }
}
