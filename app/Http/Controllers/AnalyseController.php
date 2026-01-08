<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnalyseRequest;
use App\Models\Analyse;
use App\Models\FamilleAnalyse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnalyseController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     *
     */
    public function store(StoreAnalyseRequest $request)
    {
        $analyse = Analyse::create([
            'nomAnalyse' => $request->nomAnalyse,
            'famille_analyse_id' => $request->famille_analyse_id,
        ]);
        $familleAnalyse = FamilleAnalyse::all();
        
        return redirect()->back()->with('dataFA',$familleAnalyse)  ;

        // return Inertia::render('Admin/Patients/Show', [
        //     'data' => $familleAnalyse,
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analyse  $Analyse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analyse $Analyse)
    {
        $Analyse->delete();
        return redirect()->back();
    }
}
