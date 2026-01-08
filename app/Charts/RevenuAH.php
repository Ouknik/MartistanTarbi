<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenuAH
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {

        $revenueToday = DB::table('factures')
            ->whereDate('dateFacture', Carbon::today())
            ->sum('montantFacture');

        $revenueYesterday = DB::table('factures')
            ->whereDate('dateFacture', Carbon::yesterday())
            ->sum('montantFacture');


        return $this->chart->barChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle('Season 2021.')
            ->setXAxis([$revenueToday])
            ->setLabels(['Player 7'])
            ->toVue();
    }
}
