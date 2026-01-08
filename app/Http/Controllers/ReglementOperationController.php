<?php

namespace App\Http\Controllers;

use App\Models\ReglementOperation;
use App\Http\Requests\StoreReglementOperationRequest;
use App\Http\Requests\UpdateReglementOperationRequest;
use App\Models\Docteur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReglementOperationController extends Controller
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
     * @param  \App\Http\Requests\StoreReglementOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReglementOperationRequest $request)
    {
        $date = date('Y-m-d');
        $docteur = User::where('type', 'docteur')->get();
        ReglementOperation::create([
            'modeReglement' => $request->modeReglement,
            'montantReglement' => $request->montantReglement,
            'modeReglement' => $request->modeReglement,
            'clinique_id' => $request->clinique,
            'user_id' => $docteur[0]['id'],
            'dateReglement' => $date
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReglementOperation  $reglementOperation
     * @return \Illuminate\Http\Response
     */
    public function show(ReglementOperation $reglementOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReglementOperation  $reglementOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(ReglementOperation $reglementOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReglementOperationRequest  $request
     * @param  \App\Models\ReglementOperation  $reglementOperation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReglementOperationRequest $request, ReglementOperation $reglementOperation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReglementOperation  $reglementOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReglementOperation $reglementOperation)
    {
        //
    }
}
