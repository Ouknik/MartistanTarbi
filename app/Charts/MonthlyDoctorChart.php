<?php

namespace App\Charts;

use App\Models\Consultation;
use App\Models\Docteur;
use App\Models\Facture;
use App\Models\ReglementFacture;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MonthlyDoctorChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {
        $docteur = Auth::user()->id;

        // Get all invoices, group them by date, and sum the amounts for each date
        $invoiceAmountsPerDay = ReglementFacture::where('user_id', $docteur)
            ->get()
            ->groupBy(function ($invoice) {
                return Carbon::parse($invoice->dateReglement)->format('d/m/Y');
            })
            ->map(function ($invoicesPerDay) {
                return $invoicesPerDay->sum('montantReglement');
            });
        // Use the dates from the $invoiceAmountsPerDay collection for the x axis
        $invoiceDates = $invoiceAmountsPerDay->keys();

        return $this->chart->areaChart()
            // ->addArea('Consultation', $consultationAmounts->values()->toArray())
            ->addArea('Montant', $invoiceAmountsPerDay->values()->toArray())
            ->setTitle('Revenu / Jour')
            ->setColors(['#089bab', '#fd7e14'])
            ->setXAxis($invoiceDates->toArray())
            ->toVue();
    }
}
