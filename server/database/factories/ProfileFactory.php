<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Nombres de archivo de las imágenes
        $imageNames = collect([
            'image1.jpg',
            'image2.jpg',
            'image3.jpg',
            'image4.jpg',
            'image5.jpg',
            'image6.jpg',
            'image7.jpg',
            'image8.jpg',
            'image9.jpg',
            'image10.jpg',
        ])->shuffle();

        return [
            'description' => $this->faker->sentence(20),
            'vitalMoment' => $this->faker->sentence(20),
            'image' => 'images/' . $imageNames->pop(), // Asigna el último nombre de archivo de la lista y lo elimina
        ];
    }
}