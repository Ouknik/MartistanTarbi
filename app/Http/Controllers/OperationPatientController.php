<?php

namespace App\Http\Controllers;

use App\Models\OperationPatient;
use App\Http\Requests\StoreOperationPatientRequest;
use App\Http\Requests\UpdateOperationPatientRequest;
use App\Models\Assurance;
use App\Models\Clinique;
use App\Models\Patient;
use App\Models\ReglementOperation;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OperationPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliniques = Clinique::with('operations.patient')->get();
        $operations = OperationPatient::with('patient', 'clinique', 'patient.assurance')->OrderBy('orderOperation', 'asc')->get();
        return Inertia::render('Admin/Operations/Index', [
            'operations' => $operations,
            'cliniques' => $cliniques,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Operations/AddOperation',
            []
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOperationPatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperationPatientRequest $request)
    {
        $assurance=Assurance::find($request->patient_id['assurance_id']);
        $order = 0;
        $state = $request->etatOperation;
        if ($state == 'Programmer')
            $order = 1;
        if ($state == 'Reporter')
            $order = 2;
        if ($state == 'Validée')
            $order = 3;
        if ($state == 'Annuler')
            $order = 4;
        OperationPatient::create([
            'dateOperation' => $request->dateOperation,
            'prixOperation' => $request->prixOperation,
            'MontantValideeOperation' => $request->MontantValideeOperation,
            'MontantRestantOperation' => $request->MontantRestantOperation,
            'nomOperation' => $request->typeOperation,
            'descriptionOperation' => $request->descriptionOperation,
            'etatOperation' => $request->etatOperation,
            'clinique_id' => $request->clinique,
            'patient_id' => $request->patient_id['id'],
            'orderOperation' => $order,
            'typeAssurance'=>$assurance->typeAssurance
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OperationPatient  $operationPatient
     * @return \Illuminate\Http\Response
     */
    public function show(OperationPatient $operationPatient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OperationPatient  $operationPatient
     * @return \Illuminate\Http\Response
     */
    public function edit(OperationPatient $operationPatient)
    {
        // return Inertia::render(
        //     'Admin/Operations/ProchaineOperation',
        // );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOperationPatientRequest  $request
     * @param  \App\Models\OperationPatient  $operationPatient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperationPatientRequest $request, OperationPatient $operation)
    {
        $order = 0;
        $state = $request->etatOperation;
        if ($state == 'Programmer')
            $order = 1;
        if ($state == 'Reporter')
            $order = 2;
        if ($state == 'Validée')
            $order = 3;
        if ($state == 'Annuler')
            $order = 4;

        $operation->dateOperation = $request->dateOperation;
        $operation->MontantValideeOperation = $request->MontantValideeOperation;
        $operation->descriptionOperation = $request->descriptionOperation;
        $operation->MontantRestantOperation = $request->MontantRestantOperation;
        $operation->nomOperation = $request->nomOperation;
        $operation->etatOperation = $request->etatOperation;
        $operation->prixOperation = $request->prixOperation;
        $operation->clinique_id = $request->clinique_id;
        $operation->patient_id = $request->patient_id;
        $operation->orderOperation = $order;
        $operation->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OperationPatient  $operationPatient
     * @return \Illuminate\Http\Response
     */
    public function destroy($operationPatient)
    {
        OperationPatient::findOrFail($operationPatient)->delete();
        return redirect()->back();
    }

    public function updateOperation(Request $request, OperationPatient $operationPatient)
    {
        $operationPatient = OperationPatient::find($operationPatient);
        return response()->json($operationPatient);
    }
}
