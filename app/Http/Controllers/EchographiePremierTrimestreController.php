<?php

namespace App\Http\Controllers;

use App\Models\EchographiePremierTrimestre;
use App\Http\Requests\StoreEchographiePremierTrimestreRequest;
use App\Http\Requests\UpdateEchographiePremierTrimestreRequest;
use App\Models\Consultation;
use App\Models\EchographieDeuxiemeTrimestre;
use Inertia\Inertia;

class EchographiePremierTrimestreController extends Controller
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
            'Admin/EchographiePremierTrimestre/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchographiePremierTrimestreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographiePremierTrimestreRequest $request)
    {
        $date = date('Y-m-d');
        $latestConsultation = Consultation::where('patient_id', $request->patient['id'])->latest()->first();
        EchographiePremierTrimestre::create([
            'indication' => $request->indication,
            'uterus' => $request->uterus,
            'oeufUnique' => $request->oeufUnique,
            'aspect' => $request->aspect,
            'vesicule_ombilicale' => $request->vesicule_ombilicale,
            'embryonUnique' => $request->embryonUnique,
            'activite_cardiaque' => $request->activite_cardiaque,
            'mouvements_actifs' => $request->mouvements_actifs,
            'clarte_nucale' => $request->clarte_nucale,
            'long_cranio_caudale' => $request->long_cranio_caudale,
            'diametre_biparietal' => $request->diametre_biparietal,
            'long_cranio_caudaleSoitSemaines' => $request->long_cranio_caudaleSoitSemaines,
            'long_cranio_caudaleSoitJours' => $request->long_cranio_caudaleSoitJours,
            'diametre_biparietalSoitSemaines' => $request->diametre_biparietalSoitSemaines,
            'diametre_biparietalSoitJours' => $request->diametre_biparietalSoitJours,
            'annexe_gauche' => $request->annexe_gauche,
            'annexe_droite' => $request->annexe_droite,
            'conclusion' => $request->conclusion,
            'conclusionde' => $request->conclusionde,
            'date'=>$date,
            'consultation_id' => $request->consultation_id,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographiePremierTrimestre  $echographiePremierTrimestre
     * @return \Illuminate\Http\Response
     */
    public function show(EchographiePremierTrimestre $echographiePremierTrimestre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographiePremierTrimestre  $echographiePremierTrimestre
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographiePremierTrimestre $echographiePremierTrimestre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographiePremierTrimestreRequest  $request
     * @param  \App\Models\EchographiePremierTrimestre  $echographiePremierTrimestre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographiePremierTrimestreRequest $request, EchographiePremierTrimestre $echographiePremierTrimestre)
    {
        $echographiePremierTrimestre = EchographiePremierTrimestre::find($request->id);
        if (!$echographiePremierTrimestre) {
            return redirect()->back()->with('error', 'echographiePremierTrimestre not found');
        }
        $echographiePremierTrimestre->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographiePremierTrimestre  $echographiePremierTrimestre
     * @return \Illuminate\Http\Response
     */
    public function destroy( $echographiePremierTrimestreDelete)
    {
        EchographiePremierTrimestre::findOrFail($echographiePremierTrimestreDelete)->delete();
        return redirect()->back();
    }
}
