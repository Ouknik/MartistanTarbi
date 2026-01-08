<?php

namespace App\Http\Controllers;

use App\Models\EchographiePelvienne;
use App\Http\Requests\StoreEchographiePelvienneRequest;
use App\Http\Requests\UpdateEchographiePelvienneRequest;
use App\Models\Consultation;
use Inertia\Inertia;

class EchographiePelvienneController extends Controller
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
            'Admin/EchographiePelviennes/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchographiePelvienneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographiePelvienneRequest $request)
    {
        //dd($request->consultation_id);
        $date = date('Y-m-d');
        $latestConsultation = Consultation::where('patient_id', $request->patient['id'])->latest()->first();
        EchographiePelvienne::create([
            'indication' => $request->indication,
            'vessie' => $request->vessie,
            'vaginetcol' => $request->vaginetcol,
            'uterus_position' => $request->uterus_position,
            'uterus_contours' => $request->uterus_contours,
            'uterus_echo_structure' => $request->uterus_echo_structure,
            'endometre' => $request->endometre,
            'uterine_cavite' => $request->uterine_cavite,
            'ovaire_droit' => $request->ovaire_droit,
            'ovaire_gauche' => $request->ovaire_gauche,
            'trompe_droit' => $request->trompe_droit,
            'trompe_gauche' => $request->trompe_gauche,
            'douglass' => $request->douglass,
            'conclusion' => $request->conclusion,
            'date' => $date,
            'consultation_id' => $request->consultation_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographiePelvienne  $echographiePelvienne
     * @return \Illuminate\Http\Response
     */
    public function show(EchographiePelvienne $echographiePelvienne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographiePelvienne  $echographiePelvienne
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographiePelvienne $echographiePelvienne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographiePelvienneRequest  $request
     * @param  \App\Models\EchographiePelvienne  $echographiePelvienne
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographiePelvienneRequest $request, EchographiePelvienne $echographiePelvienne)
    {
        $echographiePelvienne = EchographiePelvienne::find($request->id);
        if (!$echographiePelvienne) {
            return redirect()->back()->with('error', 'echographiePelvienne not found');
        }
        $echographiePelvienne->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographiePelvienne  $echographiePelvienne
     * @return \Illuminate\Http\Response
     */
    public function destroy($echographiePelvienneDelete)
    {
        EchographiePelvienne::findOrFail($echographiePelvienneDelete)->delete();
        return redirect()->back();
    }
}
