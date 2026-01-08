<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::factory()->create([
            'id'=>1,
            'name'=>'Admin'
        ]);
        Role::factory()->create([
            'id'=>2,
            'name'=>'Docteur'
        ]);

        Role::factory()->create([
            'id'=>3,
            'name'=>'Secretaire'
        ]);
    }
}
