<?php

namespace App\Http\Controllers;

use App\Models\EchographieDeuxiemeTrimestreGem;
use App\Http\Requests\StoreEchographieDeuxiemeTrimestreGemRequest;
use App\Http\Requests\UpdateEchographieDeuxiemeTrimestreGemRequest;
use App\Models\Consultation;
use App\Models\EchographiePremierTrimestreGem;
use Inertia\Inertia;

class EchographieDeuxiemeTrimestreGemController extends Controller
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
            'Admin/EchographiePremierTrimestreGems/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchographieDeuxiemeTrimestreGemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographieDeuxiemeTrimestreGemRequest $request)
    {
        //dd($request);
        $date = date('Y-m-d');
        EchographieDeuxiemeTrimestreGem::create([
            'date' => $date,
            'indication' => $request->indication,
            'grossesse_gemellaire' => $request->grossesse_gemellaire,
            'activite_cardiaque' => $request->activite_cardiaque,
            'mouvements_actifs' => $request->mouvements_actifs,
            'mouvements_respiratoires' => $request->mouvements_respiratoires,
            'presentation1' => $request->presentation1,
            'presentation2' => $request->presentation2,
            'liquide_amniotique' => $request->liquide_amniotique,
            'localisation_placenta' => $request->localisation_placenta,
            'grade_placenta' => $request->grade_placenta,
            'cordon' => $request->cordon,
            'diametre_biparietal_1' => $request->diametre_biparietal_1,
            'diametre_biparietal_1_sa' => $request->diametre_biparietal_1_sa,
            'diametre_biparietal_1_j' => $request->diametre_biparietal_1_j,
            'longueur_femur_1' => $request->longueur_femur_1,
            'longueur_femur_1_sa' => $request->longueur_femur_1_sa,
            'longueur_femur_1_j' => $request->longueur_femur_1_j,
            'diametre_biparietal_2' => $request->diametre_biparietal_2,
            'diametre_biparietal_2_sa' => $request->diametre_biparietal_2_sa,
            'diametre_biparietal_2_j' => $request->diametre_biparietal_2_j,
            'longueur_femur_2' => $request->longueur_femur_2,
            'longueur_femur_2_sa' => $request->longueur_femur_2_sa,
            'longueur_femur_2_j' => $request->longueur_femur_2_j,
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
            'conclusion' => $request->conclusion,
            'consultation_id' => $request->consultation_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographieDeuxiemeTrimestreGem  $echographieDeuxiemeTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function show(EchographieDeuxiemeTrimestreGem $echographieDeuxiemeTrimestreGem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographieDeuxiemeTrimestreGem  $echographieDeuxiemeTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographieDeuxiemeTrimestreGem $echographieDeuxiemeTrimestreGem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographieDeuxiemeTrimestreGemRequest  $request
     * @param  \App\Models\EchographieDeuxiemeTrimestreGem  $echographieDeuxiemeTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographieDeuxiemeTrimestreGemRequest $request, EchographieDeuxiemeTrimestreGem $echographieDeuxiemeTrimestreGem)
    {
        $echographieDeuxiemeTrimestreGem = EchographieDeuxiemeTrimestreGem::find($request->id);
        if (!$echographieDeuxiemeTrimestreGem) {
            return redirect()->back()->with('error', 'echographieDeuxiemeTrimestreGem not found');
        }
        $echographieDeuxiemeTrimestreGem->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographieDeuxiemeTrimestreGem  $echographieDeuxiemeTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function destroy($echographieDeuxiemeTrimestreGemDelete)
    {
        EchographieDeuxiemeTrimestreGem::findOrFail($echographieDeuxiemeTrimestreGemDelete)->delete();
        return redirect()->back();
    }
}
