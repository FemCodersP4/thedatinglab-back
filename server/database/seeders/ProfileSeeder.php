<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $profiles = [
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image2.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image3.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image4.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image5.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image6.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image7.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image8.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image9.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image10.jpeg',
            ],
            [
                'description' => 'Apasionado de la tecnología y la innovación',
                'vitalMoment' =>'Descubriendo su pasión por la programación',
                'image' => 'images/image1.jpeg',
            ],
        ];

        foreach ($profiles as $profileData) {
            Profile::create($profileData);
        }
    }
}