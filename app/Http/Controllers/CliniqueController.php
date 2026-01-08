<?php

namespace App\Http\Controllers;

use App\Models\Clinique;
use App\Http\Requests\StoreCliniqueRequest;
use App\Http\Requests\UpdateCliniqueRequest;
use Inertia\Inertia;

class CliniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliniques=Clinique::with('operations')->get();
        return Inertia::render(
            [
                'cliniques'=>$cliniques
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Cliniques/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCliniqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCliniqueRequest $request)
    {
        Clinique::create([
            'nomClinique'=>$request->nomClinique,
            'villeClinique'=>$request->villeClinique
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function show(Clinique $clinique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinique $clinique)
    {
        return Inertia::render(
            'Admin/Cliniques/Edit',
            [
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCliniqueRequest  $request
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCliniqueRequest $request, Clinique $clinique)
    {
        $clinique->nomClinique = $request->nomClinique;
        $clinique->villeClinique = $request->villeClinique;
        $clinique->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinique $clinique)
    {
        $clinique->delete();
        return redirect()->back();
    }
}
