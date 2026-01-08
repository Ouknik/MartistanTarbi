<?php

namespace App\Http\Controllers;

use App\Models\Acte;
use App\Http\Requests\StoreActeRequest;
use App\Http\Requests\UpdateActeRequest;

class ActeController extends Controller
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
     * @param  \App\Http\Requests\StoreActeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acte  $acte
     * @return \Illuminate\Http\Response
     */
    public function show(Acte $acte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acte  $acte
     * @return \Illuminate\Http\Response
     */
    public function edit(Acte $acte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActeRequest  $request
     * @param  \App\Models\Acte  $acte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActeRequest $request, Acte $acte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acte  $acte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acte $acte)
    {
        //
    }
}
