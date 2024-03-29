<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Preference;

class PreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Utiliza el factory para crear 10 registros de preferencias
        Preference::factory()->count(10)->create();
    }
}