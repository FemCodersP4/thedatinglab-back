<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Preference;
use App\Models\Profile;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preferences = Preference::all();
        $profiles = Profile::all();
        
        if ($preferences->isEmpty() || $profiles->isEmpty()) {
            $this->command->info('No hay preferencias o perfiles disponibles en la base de datos.');
            return;
        }

        $users = [
            [
                'name' => 'Laura',
                'lastname' =>'Gil',
                'email' => 'laura@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Ali',
                'lastname' =>'Garcia',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Gaby',
                'lastname' =>'Garcia',
                'email' => 'gaby@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Debora',
                'lastname' =>'Garcia',
                'email' => 'debora@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Fefy',
                'lastname' =>'Garcia',
                'email' => 'fefy@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Jess',
                'lastname' =>'Garcia',
                'email' => 'jess@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Hemi',
                'lastname' =>'Garcia',
                'email' => 'hemi@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Thamy',
                'lastname' =>'Garcia',
                'email' => 'thamy@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Carlos',
                'lastname' =>'Rodríguez',
                'email' => 'carlos@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Ana',
                'lastname' =>'Sánchez',
                'email' => 'ana@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '0',
            ],
            [
                'name' => 'David',
                'lastname' =>'Martínez',
                'email' => 'david@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Elena',
                'lastname' =>'Fernández',
                'email' => 'elena@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Miguel',
                'lastname' =>'Gutiérrez',
                'email' => 'miguel@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Sara',
                'lastname' =>'Díaz',
                'email' => 'sara@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Javier',
                'lastname' =>'López',
                'email' => 'javier@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],
            [
                'name' => 'Andrea',
                'lastname' =>'Hernández',
                'email' => 'andrea@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '0',
                'over18' => '0',
            ],

        ];
        foreach ($users as $key => $userData) {
            // Verificar si hay preferencias y perfiles disponibles
            if ($preferences->isEmpty() || $profiles->isEmpty()) {
                $this->command->info('No hay preferencias o perfiles disponibles para asignar al usuario.');
                break;
            }
        
            // Obtener un índice aleatorio para seleccionar una preferencia y un perfil
            $preferenceIndex = rand(0, $preferences->count() - 1);
            $profileIndex = rand(0, $profiles->count() - 1);
        
            // Obtener la preferencia y el perfil correspondientes a los índices aleatorios
            $availablePreference = $preferences->splice($preferenceIndex, 1)->first();
            $availableProfile = $profiles->splice($profileIndex, 1)->first();
        
            // Crea el usuario con los datos y las asignaciones
            User::create([
                'name' => $userData['name'],
                'lastname' => $userData['lastname'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'privacyPolicies' => $userData['privacyPolicies'],
                'over18' => $userData['over18'],
                'preference_id' => $availablePreference->id, // Asigna el ID de la preferencia
                'profile_id' => $availableProfile->id, // Asigna el ID del perfil
            ]);
        }
    }
}