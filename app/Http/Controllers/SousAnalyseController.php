<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSousAnalyseRequest;
use App\Models\SousAnalyse;
use Illuminate\Http\Request;

class SousAnalyseController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSousAnalyseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSousAnalyseRequest $request)
    {
        SousAnalyse::create([
            'nomSousAnalyse' => $request->nomSousAnalyse,
            'analyse_id'=>$request->analyse_id
        ]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SousAnalyse  $SousAnalyse
     * @return \Illuminate\Http\Response
     */
    public function destroy(SousAnalyse $SousAnalyse)
    {
        $SousAnalyse->delete();
        return redirect()->back();
    }

}
