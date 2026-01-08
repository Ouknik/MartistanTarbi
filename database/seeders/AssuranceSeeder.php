<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Assurance;

class AssuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assurances')->insert([
            ['typeAssurance' => 'CNSS', 'imageAssurance' => 'images/assurances/CNSS.png'],
            ['typeAssurance' => 'Non Assuré', 'imageAssurance' => 'images/assurances/NonAssure.png'],
            ['typeAssurance' => 'CNOPS', 'imageAssurance' => 'images/assurances/CNOPS.png'],
            ['typeAssurance' => 'AMO', 'imageAssurance' => 'images/assurances/AMO.jpg']
        ]);
    }
}
