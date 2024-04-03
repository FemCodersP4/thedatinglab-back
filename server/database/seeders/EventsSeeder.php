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
        $numberOfEvents = 5;
        Event::factory()->times($numberOfEvents)->create();
    }
}
