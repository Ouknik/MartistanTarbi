<?php

namespace App\Http\Controllers;

use App\Models\Echographie;
use App\Http\Requests\StoreEchographieRequest;
use App\Http\Requests\UpdateEchographieRequest;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EchographieController extends Controller
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
     * @param  \App\Http\Requests\StoreEchographieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEchographieRequest $request)
    {
        $date = date('Y-m-d');
        $content = $request->contenu;
        $identifier = uniqid();

        $patientId = $request->patient['id']; // Get patient ID
        $patientDirectory = 'Echographies/' . $patientId; // Directory path for the patient

        // Check if the directory exists, if not, create it
        Storage::disk('public')->makeDirectory($patientDirectory);

        // Store the file in the patient-specific directory
        Storage::disk('public')->put($patientDirectory . '/' . $identifier . '.html', $content);

        Echographie::create([
            'typeEcho' => $request->typeEcho,
            'dateEcho' => $date,
            'contenuEcho' => $identifier,
            'consultation_id' => $request->consultation_id,
            'patient_id' => $patientId,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Echographie  $echographie
     * @return \Illuminate\Http\Response
     */
    public function show(Echographie $echographie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Echographie  $echographie
     * @return \Illuminate\Http\Response
     */
    public function edit(Echographie $echographie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchographieRequest  $request
     * @param  \App\Models\Echographie  $echographie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEchographieRequest $request, Echographie $echographie)
    {
        // Retrieve the echography by its ID
        $echographie = Echographie::find($request->id);
        if (!$echographie) {
            // Handle the case where the echography doesn't exist
            return redirect()->back()->withErrors('Echographie not found.');
        }

        // Construct the file path including the patient's folder
        $patientId = $echographie->patient_id; // assuming you have patient_id in your Echographie model
        $filePath = 'Echographies/' . $patientId . '/' . $echographie->contenuEcho . '.html';

        // Get the updated content from the request
        $content = $request->contenuEcho;

        // Update the file content in the patient-specific folder
        Storage::disk('public')->put($filePath, $content);

        // Update the echography details in the database
        $echographie->update([
            'typeEcho' => $request->typeEcho,
            'dateEcho' => $request->dateEcho,
            // If the file name/identifier is not changing, no need to update 'contenuEcho'
            'consultation_id' => $request->consultation_id,
            // Assuming patient_id does not change, but if it does, handle it accordingly
        ]);

        // Redirect back or to another location as required
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Echographie  $echographie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $echographie = Echographie::findOrFail($request->id);
        $patientId = $echographie->patient_id;
        Storage::disk('public')->delete('Echographies/' . $patientId . '/' . $echographie->contenuEcho . '.html');
        $echographie->delete();
        return redirect()->back();
    }
}
