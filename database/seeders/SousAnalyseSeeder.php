<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SousAnalyseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sous_analyses')->insert([
            ['id' => 1, 'nomSousAnalyse' => 'Antigène Hbs', 'analyse_id' => 74],
            ['id' => 2, 'nomSousAnalyse' => 'Antigène Hbe', 'analyse_id' => 74],
            ['id' => 3, 'nomSousAnalyse' => 'Anticorps Anti Hbc', 'analyse_id' => 74],
            ['id' => 4, 'nomSousAnalyse' => 'Anticorps Anti Hbs', 'analyse_id' => 74],
            ['id' => 5, 'nomSousAnalyse' => 'Anticorps Anti Hbe', 'analyse_id' => 74],
        ]);
    }
}
