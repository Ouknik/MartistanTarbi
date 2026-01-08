<?php

namespace App\Http\Controllers;

use App\Events\Analyses;
use App\Http\Requests\StoreFamilleAnalyseRequest;
use App\Models\FamilleAnalyse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FamilleAnalyseController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $analyses = FamilleAnalyse::all();
        // return Inertia::render('Admin/Parametrage/Index', [
        //     'analyses'=>$analyses
        // ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFamilleAnalyseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilleAnalyseRequest $request)
    {
        FamilleAnalyse::create([
            'familleanalyse' => $request->familleanalyse,
        ]);

        event(new Analyses());

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilleAnalyse  $familleAnalyse
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilleAnalyse $familleAnalyse)
    {
        dd($familleAnalyse);
        $familleAnalyse->delete();
        return redirect()->back();
    }
}
