<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Laura',
                'email' => 'laura@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ],
            [
                'name' => 'Ali',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Gaby',
                'email' => 'gaby@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Debora',
                'email' => 'debora@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Fefy',
                'email' => 'fefy@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Jess',
                'email' => 'jess@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Hemi',
                'email' => 'hemi@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Thamy',
                'email' => 'thamy@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            
        ];
            DB::table('users')->insert($users);
    }
}