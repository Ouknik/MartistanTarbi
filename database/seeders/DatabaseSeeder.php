<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Assurance;
use App\Models\Paiement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Central Database Seeders (Plans & Super Admin)
        $this->call([
            PlanSeeder::class,
            SuperAdminSeeder::class,
        ]);

        // Tenant Database Seeders (Original seeders - run in tenant context)
        // These will be called when creating tenant databases
    }

    /**
     * Seed tenant-specific data.
     * Called when initializing a new tenant database.
     */
    public function runTenantSeeders()
    {
        Paiement::factory(4)->create();
        $this->call([
            RoleSeeder::class,
            VilleSeeder::class,
            AssuranceSeeder::class,
            FamilleAnalyseSeeder::class,
            AnalyseSeeder::class,
            SousAnalyseSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}
