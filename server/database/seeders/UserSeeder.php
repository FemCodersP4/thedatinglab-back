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

        ];
        foreach ($users as $key => $userData) {

            $availablePreferences = $preferences->whereNotIn('id', User::pluck('preference_id')->toArray());

            $userData['preference_id'] = $availablePreferences->random()->id;
            $userData['profile_id'] = $profiles->random()->id;
            User::create($userData);
        }
    }
}
