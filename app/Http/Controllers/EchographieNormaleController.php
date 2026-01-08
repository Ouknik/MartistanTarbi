<?php

namespace App\Http\Controllers;

use App\Events\Consultations;
use App\Models\EchographieNormale;
use App\Http\Requests\StoreEchographieNormaleRequest;
use App\Http\Requests\UpdateEchographieNormaleRequest;
use App\Models\Consultation;
use App\Models\EchographieMammaire;
use Inertia\Inertia;

class EchographieNormaleController extends Controller
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
            'Admin/EchographieNormale/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchographieNormaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographieNormaleRequest $request)
    {
        $date = date('Y-m-d');
        EchographieNormale::create([
            'date' => $date,
            'compte_rendu' => $request->compte_rendu,
            'conclusion' => $request->conclusion,
            'consultation_id' => $request->consultation_id,
        ]);
        event(new Consultations($request->patient['id'],$request->consultation_id));
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchographieNormale  $echographieNormale
     * @return \Illuminate\Http\Response
     */
    public function show(EchographieNormale $echographieNormale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchographieNormale  $echographieNormale
     * @return \Illuminate\Http\Response
     */
    public function edit(EchographieNormale $echographieNormale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographieNormaleRequest  $request
     * @param  \App\Models\EchographieNormale  $echographieNormale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographieNormaleRequest $request, EchographieNormale $echographieNormale)
    {
        $echographieNormale = EchographieNormale::find($request->id);
        if (!$echographieNormale) {
            return redirect()->back()->with('error', 'Echographie Normale not found');
        }
        $echographieNormale->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchographieNormale  $echographieNormale
     * @return \Illuminate\Http\Response
     */
    public function destroy($echographieNormaleDelete)
    {
        EchographieNormale::findOrFail($echographieNormaleDelete)->delete();
        return redirect()->back();
    }
}
