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
                'lastname' =>'Gil',
                'email' => 'laura@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ],
            [
                'name' => 'Ali',
                'lastname' =>'Garcia',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Gaby',
                'lastname' =>'Garcia',
                'email' => 'gaby@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Debora',
                'lastname' =>'Garcia',
                'email' => 'debora@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Fefy',
                'lastname' =>'Garcia',
                'email' => 'fefy@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Jess',
                'lastname' =>'Garcia',
                'email' => 'jess@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Hemi',
                'lastname' =>'Garcia',
                'email' => 'hemi@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            [
                'name' => 'Thamy',
                'lastname' =>'Garcia',
                'email' => 'thamy@gmail.com',
                'password' => Hash::make('123456'),
                'privacyPolicies' => '1',
                'over18' => '1',
            ], 
            
        ];
            DB::table('users')->insert($users);
    }
}