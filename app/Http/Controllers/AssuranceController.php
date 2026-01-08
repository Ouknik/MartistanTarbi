<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Http\Requests\StoreAssuranceRequest;
use App\Http\Requests\UpdateAssuranceRequest;
use Inertia\Inertia;

class AssuranceController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssuranceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssuranceRequest $request)
    {
        $imagepath = '';
        if ($request->imageAssurance) {
            $request->validate([
                'imageAssurance' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            if ($request->hasFile('imageAssurance')) {
                $imagepath = $request->file('imageAssurance')->store('images/assurances', 'public');
                move_uploaded_file($request->file('imageAssurance'), $imagepath);
            }
        } else {
            $imagepath = 'images/assurances/no-image-available.jpg';
        }

        Assurance::create([
            'typeAssurance' => $request->typeAssurance,
            'imageAssurance' => $imagepath,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assurance  $assurance
     * @return \Illuminate\Http\Response
     */
    public function show(Assurance $assurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assurance  $assurance
     * @return \Illuminate\Http\Response
     */
    public function edit(Assurance $assurance)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssuranceRequest  $request
     * @param  \App\Models\Assurance  $assurance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssuranceRequest $request, Assurance $assurance)
    {
        $imagepath = '';
        if ($request->imageAssurance) {
            $request->validate([
                'imageAssurance' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            if ($request->hasFile('imageAssurance')) {
                $imagepath = $request->file('imageAssurance')->store('images/assurances', 'public');
                move_uploaded_file($request->file('imageAssurance'), $imagepath);
            }
        } 

        $assurance->typeAssurance = $request->typeAssurance;
        $assurance->imageAssurance = $request->imagepath;
        $assurance->save();
        return redirect()->back()->with('message', 'Assurance modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assurance  $assurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assurance $assurance)
    {
        $assurance->delete();
        return redirect()->back();
    }
}
