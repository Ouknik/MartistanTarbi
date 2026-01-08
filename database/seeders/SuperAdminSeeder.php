<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuperAdmin::create([
            'name' => 'Super Admin',
            'email' => 'admin@maristan.ma',
            'password' => Hash::make('Admin@2026'),
            'phone' => '+212600000000',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
