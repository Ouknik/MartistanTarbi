<?php

namespace App\Http\Controllers;

use App\Events\Consultations;
use App\Models\EchographieGynecologique;
use App\Http\Requests\StoreEchographieGynecologiqueRequest;
use App\Http\Requests\UpdateEchographieGynecologiqueRequest;
use Inertia\Inertia;

class EchographieGynecologiqueController extends Controller
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
            'Admin/EchographieGynecologique/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchographieGynecologiqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographieGynecologiqueRequest $request)
    {
        // dd($request->contenu,$request->consultation_id);
        $date = date('Y-m-d');
        EchographieGynecologique::create([
            'date' => $date,
            // 'uterus' => $request->uterus,
            // 'caviteUterine' => $request->cavite_uterine,
            // 'endometre' => $request->endometre,
            // 'annexeGauche' => $request->annexe_gauche,
            // 'annexeDroite' => $request->annexe_droit,
            // 'culDeSacDouglas' => $request->cul_de_sac,
            // 'conclusion' => $request->conclusion,
            'conclusion' => $request->contenu,
            'consultation_id' => $request->consultation_id,
        ]);
        event(new Consultations($request->consultation_id));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographieGynecologique  $echographieGynecologique
     * @return \Illuminate\Http\Response
     */
    public function show(EchographieGynecologique $echographieGynecologique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographieGynecologique  $echographieGynecologique
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographieGynecologique $echographieGynecologique)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographieGynecologiqueRequest  $request
     * @param  \App\Models\EchographieGynecologique  $echographieGynecologique
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographieGynecologiqueRequest $request, EchographieGynecologique $echographieGynecologique)
    {
        $echographieGynecologique = EchographieGynecologique::find($request->id);
        if (!$echographieGynecologique) {
            return redirect()->back()->with('error', 'EchographieGynecologique not found');
        }
        $echographieGynecologique->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographieGynecologique  $echographieGynecologique
     * @return \Illuminate\Http\Response
     */
    public function destroy($EchographieGynecologiqueDelete)
    {
        EchographieGynecologique::findOrFail($EchographieGynecologiqueDelete)->delete();
        return redirect()->back();
    }
}
