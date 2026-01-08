<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnalyseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('analyses')->insert([
            ['id' => 1, 'nomAnalyse' => 'Groupe', 'famille_analyse_id' => 1],
            ['id' => 2, 'nomAnalyse' => 'Rhésus', 'famille_analyse_id' => 1],
            ['id' => 3, 'nomAnalyse' => 'RAI', 'famille_analyse_id' => 1],
            ['id' => 4, 'nomAnalyse' => 'Phénotype Rhésus', 'famille_analyse_id' => 1],
            ['id' => 5, 'nomAnalyse' => 'Coombs Indirect', 'famille_analyse_id' => 1],
            ['id' => 6, 'nomAnalyse' => 'Coombs direct', 'famille_analyse_id' => 1],
            ['id' => 7, 'nomAnalyse' => 'NFS', 'famille_analyse_id' => 2],
            ['id' => 8, 'nomAnalyse' => 'Plaquette', 'famille_analyse_id' => 2],
            ['id' => 9, 'nomAnalyse' => 'Electrophorèse de l\'hémoglobine', 'famille_analyse_id' => 2],
            ['id' => 10, 'nomAnalyse' => 'Réticulocytes', 'famille_analyse_id' => 2],
            ['id' => 11, 'nomAnalyse' => 'VS', 'famille_analyse_id' => 2],
            ['id' => 12, 'nomAnalyse' => 'CRP', 'famille_analyse_id' => 2],
            ['id' => 13, 'nomAnalyse' => 'Procalcitonine', 'famille_analyse_id' => 2],
            ['id' => 14, 'nomAnalyse' => 'TP', 'famille_analyse_id' => 3],
            ['id' => 15, 'nomAnalyse' => 'INR', 'famille_analyse_id' => 3],
            ['id' => 16, 'nomAnalyse' => 'TCK', 'famille_analyse_id' => 3],
            ['id' => 17, 'nomAnalyse' => 'Fibrinogène', 'famille_analyse_id' => 3],
            ['id' => 18, 'nomAnalyse' => 'D-Diméres', 'famille_analyse_id' => 3],
            ['id' => 19, 'nomAnalyse' => 'Sérologie toxoplasme', 'famille_analyse_id' => 3],
            ['id' => 20, 'nomAnalyse' => 'Cholésterol total', 'famille_analyse_id' => 4],
            ['id' => 21, 'nomAnalyse' => 'Cholésterol HDL', 'famille_analyse_id' => 4],
            ['id' => 22, 'nomAnalyse' => 'Cholésterol LDL', 'famille_analyse_id' => 4],
            ['id' => 23, 'nomAnalyse' => 'Triglycérides', 'famille_analyse_id' => 4],
            ['id' => 24, 'nomAnalyse' => 'Glycémie à jeun', 'famille_analyse_id' => 5],
            ['id' => 25, 'nomAnalyse' => 'Hyperglycémie provoquée', 'famille_analyse_id' => 5],
            ['id' => 26, 'nomAnalyse' => 'Hémoglobine glyquée', 'famille_analyse_id' => 5],
            ['id' => 27, 'nomAnalyse' => 'Fer Sérique', 'famille_analyse_id' => 6],
            ['id' => 28, 'nomAnalyse' => 'CTF', 'famille_analyse_id' => 6],
            ['id' => 29, 'nomAnalyse' => 'Ferritine', 'famille_analyse_id' => 6],
            ['id' => 30, 'nomAnalyse' => 'Transferrine', 'famille_analyse_id' => 6],
            ['id' => 31, 'nomAnalyse' => 'NA+', 'famille_analyse_id' => 7],
            ['id' => 32, 'nomAnalyse' => 'K+', 'famille_analyse_id' => 7],
            ['id' => 33, 'nomAnalyse' => 'CL-', 'famille_analyse_id' => 7],
            ['id' => 34, 'nomAnalyse' => 'Calcium', 'famille_analyse_id' => 7],
            ['id' => 35, 'nomAnalyse' => 'Réserve Alcaline', 'famille_analyse_id' => 7],
            ['id' => 36, 'nomAnalyse' => 'Phosphore', 'famille_analyse_id' => 7],
            ['id' => 37, 'nomAnalyse' => 'Magnésium', 'famille_analyse_id' => 7],
            ['id' => 38, 'nomAnalyse' => 'Magnésium érythrocytaire', 'famille_analyse_id' => 7],
            ['id' => 39, 'nomAnalyse' => 'Protéines', 'famille_analyse_id' => 7],
            ['id' => 40, 'nomAnalyse' => 'Acide urique', 'famille_analyse_id' => 7],
            ['id' => 41, 'nomAnalyse' => 'Diurèse', 'famille_analyse_id' => 8],
            ['id' => 42, 'nomAnalyse' => 'NA+', 'famille_analyse_id' => 8],
            ['id' => 43, 'nomAnalyse' => 'K+', 'famille_analyse_id' => 8],
            ['id' => 44, 'nomAnalyse' => 'CL-', 'famille_analyse_id' => 8],
            ['id' => 45, 'nomAnalyse' => 'Calcium', 'famille_analyse_id' => 8],
            ['id' => 46, 'nomAnalyse' => 'Phosphore', 'famille_analyse_id' => 8],
            ['id' => 47, 'nomAnalyse' => 'Urée', 'famille_analyse_id' => 8],
            ['id' => 48, 'nomAnalyse' => 'Urée', 'famille_analyse_id' => 9],
            ['id' => 49, 'nomAnalyse' => 'Créatinine', 'famille_analyse_id' => 9],
            ['id' => 50, 'nomAnalyse' => 'Clairance de la créatinine', 'famille_analyse_id' => 9],
            ['id' => 51, 'nomAnalyse' => 'Protéinurie des 24h', 'famille_analyse_id' => 9],
            ['id' => 52, 'nomAnalyse' => 'ASAT', 'famille_analyse_id' => 10],
            ['id' => 53, 'nomAnalyse' => 'ALAT', 'famille_analyse_id' => 10],
            ['id' => 54, 'nomAnalyse' => 'Phosphatase alcaline', 'famille_analyse_id' => 10],
            ['id' => 55, 'nomAnalyse' => 'Gamma GT', 'famille_analyse_id' => 10],
            ['id' => 56, 'nomAnalyse' => 'Bilirubine libre et conjuguée', 'famille_analyse_id' => 10],
            ['id' => 57, 'nomAnalyse' => '5\'Nucléotidase', 'famille_analyse_id' => 10],
            ['id' => 58, 'nomAnalyse' => 'Amylase', 'famille_analyse_id' => 10],
            ['id' => 59, 'nomAnalyse' => 'Lipase', 'famille_analyse_id' => 10],
            ['id' => 60, 'nomAnalyse' => 'Electrophorèse des protéines', 'famille_analyse_id' => 10],
            ['id' => 61, 'nomAnalyse' => 'ECBU', 'famille_analyse_id' => 11],
            ['id' => 62, 'nomAnalyse' => 'ATB gramme', 'famille_analyse_id' => 11],
            ['id' => 63, 'nomAnalyse' => 'Test de grossesse', 'famille_analyse_id' => 11],
            ['id' => 64, 'nomAnalyse' => 'Prolactine', 'famille_analyse_id' => 12],
            ['id' => 65, 'nomAnalyse' => 'FSH', 'famille_analyse_id' => 12],
            ['id' => 66, 'nomAnalyse' => 'OEstradiol', 'famille_analyse_id' => 12],
            ['id' => 67, 'nomAnalyse' => 'βHCG', 'famille_analyse_id' => 12],
            ['id' => 68, 'nomAnalyse' => 'T3', 'famille_analyse_id' => 12],
            ['id' => 69, 'nomAnalyse' => 'T4', 'famille_analyse_id' => 12],
            ['id' => 70, 'nomAnalyse' => 'TSH us', 'famille_analyse_id' => 12],
            ['id' => 71, 'nomAnalyse' => 'VDRL', 'famille_analyse_id' => 13],
            ['id' => 72, 'nomAnalyse' => 'TPHA', 'famille_analyse_id' => 13],
            ['id' => 73, 'nomAnalyse' => 'Hépatite A', 'famille_analyse_id' => 13],
            ['id' => 74, 'nomAnalyse' => 'Hépatite B', 'famille_analyse_id' => 13],
            ['id' => 75, 'nomAnalyse' => 'Hépatite C', 'famille_analyse_id' => 13],
            ['id' => 76, 'nomAnalyse' => 'ASLO', 'famille_analyse_id' => 13],
            ['id' => 77, 'nomAnalyse' => 'Coprologie', 'famille_analyse_id' => 14],
            ['id' => 78, 'nomAnalyse' => 'Parasitologie', 'famille_analyse_id' => 14],
            ['id' => 79, 'nomAnalyse' => 'PSA', 'famille_analyse_id' => 15],
            ['id' => 80, 'nomAnalyse' => 'Phosphatase acide', 'famille_analyse_id' => 15],
            ['id' => 81, 'nomAnalyse' => 'Vitamine D', 'famille_analyse_id' => 15],
            ['id' => 82, 'nomAnalyse' => 'CPK', 'famille_analyse_id' => 15],
            ['id' => 83, 'nomAnalyse' => 'Troponines', 'famille_analyse_id' => 15],
            ['id' => 84, 'nomAnalyse' => 'BNP', 'famille_analyse_id' => 15],
            ['id' => 85, 'nomAnalyse' => 'Pro BNP', 'famille_analyse_id' => 15],
        ]);
    }
}
