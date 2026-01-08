<?php

namespace App\Http\Controllers;

use App\Models\typeOperation;
use App\Http\Requests\StoretypeOperationRequest;
use App\Http\Requests\UpdatetypeOperationRequest;

class TypeOperationController extends Controller
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
     * @param  \App\Http\Requests\StoretypeOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretypeOperationRequest $request)
    {
        typeOperation::create([
            'typeOperation' => $request->typeOperation,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\typeOperation  $typeOperation
     * @return \Illuminate\Http\Response
     */
    public function show(typeOperation $typeOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\typeOperation  $typeOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(typeOperation $typeOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetypeOperationRequest  $request
     * @param  \App\Models\typeOperation  $typeOperation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetypeOperationRequest $request, typeOperation $typeOperation)
    {
        $typeOperation->typeOperation = $request->typeOperation;
        $typeOperation->save();
        return redirect()->back()->with('message', 'Operation modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\typeOperation  $typeOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(typeOperation $typeOperation)
    {
        $typeOperation->delete();
        return redirect()->back();
    }
}
