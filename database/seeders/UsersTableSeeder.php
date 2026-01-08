<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed data for the first user 
        DB::table('users')->insert([
            'name' => 'Tarbi Amina',
            'email' => 'tarbi',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
            'current_team_id' => null,
            'profile_photo_path' => '/images/logo/logoTarbi.png',
            'type' => 'docteur',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

          // Seed data for the 3 user
          DB::table('users')->insert([
            'name' => 'Secretaire',
            'email' => 'Secretaire',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
            'current_team_id' => null,
            'profile_photo_path' => '/images/logo/logoTarbi.png',
            'type' => 'secretaire',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Acceess Point',
            'email' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('accesspoint@2023'),
            'remember_token' => Str::random(10),
            'current_team_id' => null,
            'profile_photo_path' => '/images/logo/logoTarbi.png',
            'type' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

    }
}
