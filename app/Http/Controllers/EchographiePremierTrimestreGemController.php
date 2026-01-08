<?php

namespace App\Http\Controllers;

use App\Models\EchographiePremierTrimestreGem;
use App\Http\Requests\StoreEchographiePremierTrimestreGemRequest;
use App\Http\Requests\UpdateEchographiePremierTrimestreGemRequest;
use App\Models\Consultation;
use App\Models\EchographiePremierTrimestre;
use Inertia\Inertia;

class EchographiePremierTrimestreGemController extends Controller
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
     * @param  \App\Http\Requests\StoreEchographiePremierTrimestreGemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographiePremierTrimestreGemRequest $request)
    {
        $date = date('Y-m-d');
        $latestConsultation = Consultation::where('patient_id', $request->patient['id'])->latest()->first();
        EchographiePremierTrimestreGem::create([
            'date' => $date,
            'indication' => $request->indication,
            'uterus' => $request->uterus,
            'oeuf_nombre' => $request->oeuf_nombre,
            'oeuf_aspect' => $request->oeuf_aspect,
            'vesicule_ombilicale_mm' => $request->vesicule_ombilicale_mm,
            'embryon_nombre' => $request->embryon_nombre,
            'activite_cardiaque' => $request->activite_cardiaque,
            'mouvements_actifs' => $request->mouvements_actifs,
            'clarte_nucale_mm' => $request->clarte_nucale_mm,
            'long_cranio_caudale_1_mm' => $request->long_cranio_caudale_1_mm,
            'long_cranio_caudale_1_sa' => $request->long_cranio_caudale_1_sa,
            'long_cranio_caudale_1_j' => $request->long_cranio_caudale_1_j,
            'long_cranio_caudale_2_mm' => $request->long_cranio_caudale_2_mm,
            'long_cranio_caudale_2_sa' => $request->long_cranio_caudale_2_sa,
            'long_cranio_caudale_2_j' => $request->long_cranio_caudale_2_j,
            'diametre_biparietal_1_mm' => $request->diametre_biparietal_1_mm,
            'diametre_biparietal_1_sa' => $request->diametre_biparietal_1_sa,
            'diametre_biparietal_1_j' => $request->diametre_biparietal_1_j,
            'diametre_biparietal_2_mm' => $request->diametre_biparietal_2_mm,
            'diametre_biparietal_2_sa' => $request->diametre_biparietal_2_sa,
            'diametre_biparietal_2_j' => $request->diametre_biparietal_2_j,
            'annexe_gauche' => $request->annexe_gauche,
            'annexe_droite' => $request->annexe_droite,
            'conclusion' => $request->conclusion,
            'consultation_id' => $request->consultation_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographiePremierTrimestreGem  $echographiePremierTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function show(EchographiePremierTrimestreGem $echographiePremierTrimestreGem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographiePremierTrimestreGem  $echographiePremierTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographiePremierTrimestreGem $echographiePremierTrimestreGem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographiePremierTrimestreGemRequest  $request
     * @param  \App\Models\EchographiePremierTrimestreGem  $echographiePremierTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographiePremierTrimestreGemRequest $request, EchographiePremierTrimestreGem $echographiePremierTrimestreGem)
    {
        $echographiePremierTrimestreGem = EchographiePremierTrimestreGem::find($request->id);
        if (!$echographiePremierTrimestreGem) {
            return redirect()->back()->with('error', 'echographiePremierTrimestreGem not found');
        }
        $echographiePremierTrimestreGem->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographiePremierTrimestreGem  $echographiePremierTrimestreGem
     * @return \Illuminate\Http\Response
     */
    public function destroy($echographiePremierTrimestreGemDelete)
    {
        EchographiePremierTrimestreGem::findOrFail($echographiePremierTrimestreGemDelete)->delete();
        return redirect()->back();
    }
}
