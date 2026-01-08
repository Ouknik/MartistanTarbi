<?php

namespace App\Http\Controllers;

use App\Models\EchographieDeuxiemeTrimestre;
use App\Http\Requests\StoreEchographieDeuxiemeTrimestreRequest;
use App\Http\Requests\UpdateEchographieDeuxiemeTrimestreRequest;
use App\Models\Consultation;
use Inertia\Inertia;

class EchographieDeuxiemeTrimestreController extends Controller
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
            'Admin/EchographieDeuxiemeTrimestre/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchographieDeuxiemeTrimestreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographieDeuxiemeTrimestreRequest $request)
    {
        $date = date('Y-m-d');
        EchographieDeuxiemeTrimestre::create([
            'date' => $date,
            'indication' => $request->indication,
            'grossesse_unique' => $request->grossesse_unique,
            'activite_cardiaque' => $request->activite_cardiaque,
            'mouvements_actifs' => $request->mouvements_actifs,
            'mouvements_respiratoires' => $request->mouvements_respiratoires,
            'presentation' => $request->presentation,
            'liquide_amniotique' => $request->liquide_amniotique,
            'placenta_localisation' => $request->placenta_localisation,
            'placenta_grade' => $request->placenta_grade,
            'placenta_cordon' => $request->placenta_cordon,
            'diametre_biparietal' => $request->diametre_biparietal,
            'diametre_biparietal_sa' => $request->diametre_biparietal_sa,
            'diametre_biparietal_j' => $request->diametre_biparietal_j,
            'longueur_femur' => $request->longueur_femur,
            'longueur_femur_sa' => $request->longueur_femur_sa,
            'longueur_femur_j' => $request->longueur_femur_j,
            'diam_abd_trans' => $request->diam_abd_trans,
            'diam_abd_trans_sa' => $request->diam_abd_trans_sa,
            'diam_abd_trans_j' => $request->diam_abd_trans_j,
            'circonf_abd' => $request->circonf_abd,
            'circonf_abd_sa' => $request->circonf_abd_sa,
            'circonf_abd_j' => $request->circonf_abd_j,
            'crane' => $request->crane,
            'rachis' => $request->rachis,
            'coeur' => $request->coeur,
            'estomac' => $request->estomac,
            'vessie' => $request->vessie,
            'reins' => $request->reins,
            'membres' => $request->membres,
            'paroi_abdominale' => $request->paroi_abdominale,
            'consultation_id' => $request->consultation_id,
            'conclusion'=> $request->conclusion,
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographieDeuxiemeTrimestre  $echographieDeuxiemeTrimestre
     * @return \Illuminate\Http\Response
     */
    public function show(EchographieDeuxiemeTrimestre $echographieDeuxiemeTrimestre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographieDeuxiemeTrimestre  $echographieDeuxiemeTrimestre
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographieDeuxiemeTrimestre $echographieDeuxiemeTrimestre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographieDeuxiemeTrimestreRequest  $request
     * @param  \App\Models\EchographieDeuxiemeTrimestre  $echographieDeuxiemeTrimestre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographieDeuxiemeTrimestreRequest $request, EchographieDeuxiemeTrimestre $echographieDeuxiemeTrimestre)
    {
        $echographieDeuxiemeTrimestre = EchographieDeuxiemeTrimestre::find($request->id);
        if (!$echographieDeuxiemeTrimestre) {
            return redirect()->back()->with('error', 'Echographie Deuxieme Trimestre not found');
        }
        $echographieDeuxiemeTrimestre->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographieDeuxiemeTrimestre  $echographieDeuxiemeTrimestre
     * @return \Illuminate\Http\Response
     */
    public function destroy($echographieDeuxiemeTrimestreDelete)
    {
        EchographieDeuxiemeTrimestre::findOrFail($echographieDeuxiemeTrimestreDelete)->delete();
        return redirect()->back();
    }
}
