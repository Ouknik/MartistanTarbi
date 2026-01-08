<?php

namespace App\Http\Controllers;

use App\Models\EchographieMammaire;
use App\Http\Requests\StoreEchographieMammaireRequest;
use App\Http\Requests\UpdateEchographieMammaireRequest;
use App\Models\Consultation;
use Inertia\Inertia;

class EchographieMammaireController extends Controller
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
        return Inertia::render(
            'Admin/EchographieMammaire/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchographieMammaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographieMammaireRequest $request)
    {
        $date = date('Y-m-d');
        // $latestConsultation = Consultation::where('patient_id', $request->patient['id'])->latest()->first();
        EchographieMammaire::create([
            'date' => $date,
            'motif_examen' => $request->motif_examen,
            'DDR' => $request->DDR,
            'oeuf' => $request->oeuf,
            'compte_rendu' => $request->compte_rendu,
            'conclusion' => $request->conclusion,
            'consultation_id' => $request->consultation_id,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographieMammaire  $echographieMammaire
     * @return \Illuminate\Http\Response
     */
    public function show(EchographieMammaire $echographieMammaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographieMammaire  $echographieMammaire
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographieMammaire $echographieMammaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographieMammaireRequest  $request
     * @param  \App\Models\EchographieMammaire  $echographieMammaire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographieMammaireRequest $request, EchographieMammaire $echographieMammaire)
    {
        $echographieMammaire = EchographieMammaire::find($request->id);
        if (!$echographieMammaire) {
            return redirect()->back()->with('error', 'echographieMammaire  not found');
        }
        $echographieMammaire->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographieMammaire  $echographieMammaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($echographieMammaire)
    {
        EchographieMammaire::findOrFail($echographieMammaire)->delete();
        return redirect()->back();
    }
}
