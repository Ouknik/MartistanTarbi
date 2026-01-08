<?php

namespace App\Http\Controllers;

use App\Events\AddToListPatient;
use App\Events\ConsultationDone;
use App\Events\HeaderStatistiquesDoctor;
use App\Models\ReglementFacture;
use App\Http\Requests\StoreReglementFactureRequest;
use App\Http\Requests\UpdateReglementFactureRequest;
use App\Models\Assurance;
use App\Models\Patient;
use Carbon\Carbon;

class ReglementFactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReglementFactureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReglementFactureRequest $request)
    {
        // dd($request);
        $dateAujourdhui = Carbon::now()->toDateString();
        $patient = Patient::findOrFail($request->patient_id);
        $typeAssurance = Assurance::where('id', $patient->assurance_id)->first();
        ReglementFacture::create([
            'montantReglement' => $request->montantReglement,
            'modePaiement' => $request->modePaiement,
            'dateReglement' => $request->dateReglement,
            'motifVisite' => $request->motifVisite,
            'patient_id' => $request->patient_id,
            'user_id' => $request->user_id,
            'typeAssurance'=> $typeAssurance->typeAssurance
        ]);
        event(new AddToListPatient());
        event(new  ConsultationDone());
        event(new HeaderStatistiquesDoctor());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReglementFacture  $reglementFacture
     * @return \Illuminate\Http\Response
     */
    public function show(ReglementFacture $reglementFacture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReglementFacture  $reglementFacture
     * @return \Illuminate\Http\Response
     */
    public function edit(ReglementFacture $reglementFacture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReglementFactureRequest  $request
     * @param  \App\Models\ReglementFacture  $reglementFacture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReglementFactureRequest $request, ReglementFacture $reglementFacture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReglementFacture  $reglementFacture
     * @return \Illuminate\Http\Response
     */
    public function destroy( $reglementFacture)
    {
        ReglementFacture::findOrFail($reglementFacture)->delete();
        event(new  ConsultationDone());
    }
}
