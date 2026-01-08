<?php

namespace App\Charts;

use App\Models\Consultation;
use App\Models\Facture;
use App\Models\ReglementFacture;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class MontantDoctorChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {
        $invoiceAmountsPerMonth = ReglementFacture::all()
            ->groupBy(function ($invoice) {
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                return Carbon::parse($invoice->dateReglement)->formatLocalized('%B %Y');
            })
            ->map(function ($invoicesPerMonth) {
                return $invoicesPerMonth->sum('montantReglement');
            });

        $invoiceMonths = $invoiceAmountsPerMonth->keys();


        return $this->chart->barChart()
            ->addData('Contrôle', $invoiceAmountsPerMonth->values()->toArray())
            ->setTitle('Revenu Mensuel / DH')
            ->setSubtitle('')
            ->setXAxis($invoiceMonths->toArray())
            ->setColors(['#089bab'])
            ->toVue();
    }

}
