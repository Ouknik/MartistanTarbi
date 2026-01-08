<?php

namespace App\Charts;

use App\Models\Assurance;
use App\Models\Patient;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;


class AssuranceChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {


        //$count=DB::table('medicaments')->count();
        //$nomAssurance = DB::table('assurances')->get();
        $nomAssurance=Assurance::select()->get();
        $countAssurance= Patient::select()->get();

        $nomAssuranceR= [] ;
        $countAssurance=[] ;
        foreach ($nomAssurance as $assurance) {
            $nomAssuranceR[]=$assurance->typeAssurance;
            $countAssurance [] = Patient::where('assurance_id', $assurance->id )->count();

        }

        return $this->chart->donutChart()
            ->addData($countAssurance)
            ->setTitle('Nombre Patient / Assurance')
            ->setSubtitle('')
            ->setLabels($nomAssuranceR)
            ->toVue();
    }
}
