<?php

namespace App\Http\Controllers;

use App\Events\ConsultationDone;
use App\Models\Facture;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;
use App\Models\Paiement;
use App\Models\Patient;
use Inertia\Inertia;
use App\Utils\NumberToWordsFrench;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with('paiements')->get();
        return Inertia::render('Admin/Facture/Index', [
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paiements = Paiement::all();
        $patients = Patient::all();
        return Inertia::render(
            'Admin/Factures/Create',
            [
                'paiements' => $paiements,
                'patients' => $patients,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFactureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactureRequest $request)
    {
        Facture::create([
            'dateFacture' => $request->dateFacture,
            'tvaFacture' => $request->tvaFacture,
            'montantFacture' => $request->montantFacture,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        return Inertia::render(
            'Admin/Factures/Show',
            []
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        return Inertia::render(
            'Admin/Factures/Edit'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFactureRequest  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFactureRequest $request, Facture $facture)
    {
        if ($request->soins) {
            $soinsFacture = json_encode($request->soins);
        }
        $montantLettre = NumberToWordsFrench::convert($request->total);
        $facture->montantFacture = $request->total;
        $facture->soins = $soinsFacture;
        $facture->montantLettre = $montantLettre;
        $facture->save();
        event(new ConsultationDone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('acture.index')->with('message', 'Facture supprimer avec Succés');
    }
}
