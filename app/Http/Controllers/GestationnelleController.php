<?php

namespace App\Http\Controllers;

use App\Models\Gestationnelle;
use App\Http\Requests\StoreGestationnelleRequest;
use App\Http\Requests\UpdateGestationnelleRequest;
use Inertia\Inertia;

class GestationnelleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Patients/Show'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGestationnelleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGestationnelleRequest $request)
    {
        Gestationnelle::create([
            'dateDernierRegle' => $request->dateDernierRegle,
            'dateGrosesse' => $request->dateGrosesse,
            'dateAccouchement' => $request->dateAccouchement,
            'patient_id' => $request->patient
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gestationnelle  $gestationnelle
     * @return \Illuminate\Http\Response
     */
    public function show(Gestationnelle $gestationnelle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gestationnelle  $gestationnelle
     * @return \Illuminate\Http\Response
     */
    public function edit(Gestationnelle $gestationnelle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGestationnelleRequest  $request
     * @param  \App\Models\Gestationnelle  $gestationnelle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGestationnelleRequest $request, Gestationnelle $gestationnelle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gestationnelle  $gestationnelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gestationnelle $gestationnelle)
    {
        //
    }
}
