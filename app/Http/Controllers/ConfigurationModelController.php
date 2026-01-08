<?php

namespace App\Http\Controllers;

use App\Models\ConfigurationModel;
use App\Http\Requests\StoreConfigurationModelRequest;
use App\Http\Requests\UpdateConfigurationModelRequest;

class ConfigurationModelController extends Controller
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
     * @param  \App\Http\Requests\StoreConfigurationModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConfigurationModelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConfigurationModel  $configurationModel
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigurationModel $configurationModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConfigurationModel  $configurationModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigurationModel $configurationModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConfigurationModelRequest  $request
     * @param  \App\Models\ConfigurationModel  $configurationModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigurationModelRequest $request, ConfigurationModel $configurationModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConfigurationModel  $configurationModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigurationModel $configurationModel)
    {
        //
    }
}
