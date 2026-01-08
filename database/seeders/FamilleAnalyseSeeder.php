<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilleAnalyseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('famille_analyses')->insert([
            ['id' => 1, 'familleanalyse' => 'Groupage sanguin'],
            ['id' => 2, 'familleanalyse' => 'Hématologie/infectiologie'],
            ['id' => 3, 'familleanalyse' => 'Bilan d\'hémostase'],
            ['id' => 4, 'familleanalyse' => 'Bilan lipdique'],
            ['id' => 5, 'familleanalyse' => 'Bilan glycémique'],
            ['id' => 6, 'familleanalyse' => 'Bilan martial'],
            ['id' => 7, 'familleanalyse' => 'Ionogramme sanguin'],
            ['id' => 8, 'familleanalyse' => 'Ionogramme urinaire'],
            ['id' => 9, 'familleanalyse' => 'Fonction rénale'],
            ['id' => 10, 'familleanalyse' => 'Fonction hépatique et pancréatique'],
            ['id' => 11, 'familleanalyse' => 'Examen des urines'],
            ['id' => 12, 'familleanalyse' => 'Bilan hormonal'],
            ['id' => 13, 'familleanalyse' => 'Sérologie et immunologie'],
            ['id' => 14, 'familleanalyse' => 'Examen des selles'],
            ['id' => 15, 'familleanalyse' => 'Divers'],
        ]);
    }
}
