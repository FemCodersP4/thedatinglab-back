<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Cata de vinos',
                'date' => '2024-04-23',
                'time' => '18:00:00',
                'description' => 'Magnifica ocasion para cata de vinos',
                'image' => 'upload/test1.jpg',
                'user_id' => '1',
            ],
            [
                'title' => 'Exposición de Arte Contemporáneo',
                'date' => '2024-06-02',
                'time' => '10:00:00',
                'description' => 'Descubre las últimas obras de artistas contemporáneos emergentes en esta exposición imperdible.',
                'image' => 'upload/test2.jpg',
                'user_id' => '1',
            ],
            [
                'title' => 'Taller de Cocina: Cocina Tailandesa',
                'date' => '2024-07-08',
                'time' => '14:00:00',
                'description' => 'Aprende a cocinar platos auténticos de Tailandia de la mano de chefs expertos.',
                'image' => 'upload/test2.jpg',
                'user_id' => '1',
            ],
            [
                'title' => 'Feria de Libros Antiguos',
                'date' => '2024-08-20',
                'time' => '11:00:00',
                'description' => 'Explora una colección única de libros antiguos y raros en esta feria literaria especializada.',
                'image' => 'upload/test4.jpg',
                'user_id' => '1',
            ],
            [
                'title' => 'Festival de Comida Internacional',
                'date' => '2024-09-17',
                'time' => '17:00:00',
                'description' => 'Prueba una amplia variedad de delicias culinarias de todo el mundo en este festival gastronómico multicultural.',
                'image' => 'upload/test5.jpg',
                'user_id' => '1',
            ],
            
        ];
            DB::table('events')->insert($events);
    }
}