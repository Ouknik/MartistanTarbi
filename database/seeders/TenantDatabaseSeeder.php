<?php

namespace Database\Seeders;

use App\Models\Paiement;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the tenant's database.
     * Called when initializing a new tenant database.
     *
     * @return void
     */
    public function run()
    {
        // Create default payment methods
        Paiement::factory(4)->create();

        // Run all required seeders for a new tenant
        $this->call([
            RoleSeeder::class,
            VilleSeeder::class,
            AssuranceSeeder::class,
            FamilleAnalyseSeeder::class,
            AnalyseSeeder::class,
            SousAnalyseSeeder::class,
        ]);

        // Note: We don't call UsersTableSeeder here because
        // the tenant admin user is created during tenant registration
    }
}
