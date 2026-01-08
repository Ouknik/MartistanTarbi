<?php

namespace App\Http\Controllers;

use App\Models\MotifVisite;
use App\Http\Requests\StoreMotifVisiteRequest;
use App\Http\Requests\UpdateMotifVisiteRequest;

class MotifVisiteController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMotifVisiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotifVisiteRequest $request)
    {
        MotifVisite::create([
            'motifVisite' => $request->motifVisite,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MotifVisite  $motifVisite
     * @return \Illuminate\Http\Response
     */
    public function show(MotifVisite $motifVisite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MotifVisite  $motifVisite
     * @return \Illuminate\Http\Response
     */
    public function edit(MotifVisite $motifVisite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMotifVisiteRequest  $request
     * @param  \App\Models\MotifVisite  $motifVisite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotifVisiteRequest $request, MotifVisite $motifvisite)
    {
        // dd($motifvisite->motifVisite ,$request->motifVisite);
        $motifvisite->motifVisite = $request->motifVisite;
        $motifvisite->save();
        return redirect()->back()->with('message', 'Motif Visite modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MotifVisite  $motifVisite
     * @return \Illuminate\Http\Response
     */
    public function destroy($MotifVisite)
    {
        MotifVisite::findOrFail($MotifVisite)->delete();
        return redirect()->back();
    }
}
