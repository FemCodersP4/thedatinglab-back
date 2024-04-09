<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event; 

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'image' => 'uploads/test1.jpg',
                'date' => '2024-04-15',
                'time' => '18:00',
                'location' => 'Bodega Vinum',
                'title' => 'Cata de vinos',
                'description' => 'Una experiencia única para disfrutar y aprender sobre vinos.',
                'shortDescription' => 'Descubre y disfruta de los mejores vinos en nuestra cata especial.',
                'user_id' => 1,
            ],
            [
                'image' => 'uploads/test2.jpg',
                'date' => '2024-04-20',
                'time' => '19:30',
                'location' => 'Restaurante Sensus',
                'title' => 'Cena con experiencias sensoriales',
                'description' => 'Una cena donde todos tus sentidos serán estimulados.',
                'shortDescription' => 'Vive una experiencia culinaria única con estímulos para tus sentidos.',
                'user_id' => 1,
            ],
            [
                'image' => 'uploads/test3.jpg',
                'date' => '2024-02-25',
                'time' => '20:00',
                'location' => 'Teatro Acústico',
                'title' => 'Concierto acústico',
                'description' => 'Disfruta de la música en un ambiente íntimo y acogedor.',
                'shortDescription' => 'Concierto especial en acústico, para una experiencia musical única.',
                'user_id' => 1,
            ],
            [
                'image' => 'uploads/test4.jpg',
                'date' => '2024-03-05',
                'time' => '19:00',
                'location' => 'Café Literario',
                'title' => 'Noche de poesía',
                'description' => 'Ven y comparte tus versos favoritos o simplemente disfruta de la poesía de otros.',
                'shortDescription' => 'Una noche para compartir y disfrutar de la belleza de la poesía.',
                'user_id' => 1,
            ],
            [
                'image' => 'uploads/test5.jpg',
                'date' => '2024-05-10',
                'time' => '20:00',
                'location' => 'Escuela de Cocina Creativa',
                'title' => 'Taller de cocina creativa',
                'description' => 'Aprende a cocinar platos innovadores y sorprende a tus amigos y familiares.',
                'shortDescription' => 'Descubre técnicas y recetas para una cocina creativa e innovadora.',
                'user_id' => 1,
            ],
            [
                'image' => 'uploads/test6.jpg',
                'date' => '2024-04-20',
                'time' => '19:00',
                'location' => 'Jardín Botánico',
                'title' => 'Picnic bajo las estrellas',
                'description' => 'Disfruten de una velada romántica con un picnic al aire libre bajo un cielo estrellado.',
                'shortDescription' => 'Picnic romántico en el Jardín Botánico.',
                'user_id' => 1,
            ],
            [
                'image' => 'uploads/test7.jpg',
                'date' => '2024-05-25',
                'time' => '20:30',
                'location' => 'Restaurante Amore',
                'title' => 'Cena a la luz de las velas',
                'description' => 'Compartan una cena íntima y deliciosa en nuestro restaurante, con una decoración romántica y velas.',
                'shortDescription' => 'Cena romántica a la luz de las velas en Restaurante Amore.',
                'user_id' => 1,
            ],
            [
                'image' => 'uploads/test8.jpg',
                'date' => '2024-07-10',
                'time' => '20:30',
                'location' => 'Restaurante El Refugio del Amor',
                'title' => 'Noche de degustación de vinos y cena gourmet',
                'description' => 'Disfruten de una experiencia culinaria única con una degustación de vinos seguida de una cena gourmet en nuestro restaurante.',
                'shortDescription' => 'Degustación de vinos y cena gourmet en Restaurante El Refugio del Amor.',
                'user_id' => 1,
            ],

            [
                'image' => 'uploads/test9.jpg',
                'date' => '2024-06-25',
                'time' => '20:00',
                'location' => 'Restaurante La Luna',
                'title' => 'Cena romántica bajo las estrellas',
                'description' => 'Disfruten de una cena exquisita en nuestro restaurante, con una decoración especial y vistas panorámicas de la ciudad.',
                'shortDescription' => 'Cena romántica bajo las estrellas en Restaurante La Luna.',
                'user_id' => 1,
            ],

            [
                'image' => 'uploads/test10.jpg',
                'date' => '2024-07-01',
                'time' => '19:30',
                'location' => 'Restaurante El Jardín Secreto',
                'title' => 'Cena sorpresa',
                'description' => 'Cena misteriosa y emocionante en nuestro restaurante secreto.',
                'shortDescription' => 'Cena sorpresa en Restaurante El Jardín Secreto.',
                'user_id' => 1,
            ],
          
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}