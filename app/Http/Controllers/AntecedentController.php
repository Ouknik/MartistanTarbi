<?php

namespace App\Http\Controllers;

use App\Events\Antecedent as EventsAntecedent;
use App\Events\PatientEvent;
use App\Models\Antecedent;
use App\Http\Requests\StoreAntecedentRequest;
use App\Http\Requests\UpdateAntecedentRequest;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Http\Request;


class AntecedentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $antecedents = Antecedent::all();
        return redirect()->back()->with('antecedents', $antecedents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Antecedents/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAntecedentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAntecedentRequest $request)
    {
        $antecedent = Antecedent::create([
            'nomAntecedent' => $request->nomAntecedent,
            'typeAntecedent' => $request->typeAntecedent,
        ]);

        $patients = Patient::all();

        // Attacher l'antécédent à tous les patients
        foreach ($patients as $patient) {
            $patient->Antecedents()->attach($antecedent, [
                'valeurAntecedent' => '',
                'descriptientAntecedent' => ''
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Antecedent  $antecedent
     * @return \Illuminate\Http\Response
     */
    public function show(Antecedent $antecedent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Antecedent  $antecedent
     * @return \Illuminate\Http\Response
     */
    public function edit(Antecedent $antecedent)
    {
        return Inertia::render(
            'Admin/Antecedants/Edit',
            [
                'antecedant' => $antecedent,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAntecedentRequest  $request
     * @param  \App\Models\Antecedent  $antecedent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAntecedentRequest $request, Antecedent $antecedent)
    {
        // dd($antecedent);
        $antecedent->nomAntecedent = $request->nomAntecedent;
        $antecedent->typeAntecedent = $request->typeAntecedent;
        $antecedent->save();
        return redirect()->back()->with('message', 'Antecedant modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Antecedent  $antecedent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antecedent $antecedent)
    {
        $patients = Patient::all();

        foreach ($patients as $patient) {
            $patient->Antecedents()->detach($antecedent);
        }
        $antecedent->delete();
        return redirect()->back();
    }


    public function updateAntecedants(Request $request)
    {
        // dd($request);
        $antecedents = $request->json()->all();
        foreach ($antecedents as $antecedent) {
            $id = $antecedent['id'];
            $nouvelleValeurAntecedent = $antecedent['pivot']['valeurAntecedent'];
            $nouveauDescriptifAntecedent = $antecedent['pivot']['descriptientAntecedent'];
            $patient_id = $antecedent['pivot']['patient_id'];
            $patient = Patient::findOrFail($patient_id);
            // dd($patient);

            DB::table('patients_antecedents')
                ->where('antecedent_id', $id)
                ->where('patient_id', $patient_id)
                ->update([
                    'valeurAntecedent' => $nouvelleValeurAntecedent,
                    'descriptientAntecedent' => $nouveauDescriptifAntecedent,
                ]);
        }
        event(new EventsAntecedent($patient));
        event(new PatientEvent($patient));
        // return redirect()->route('patients.show', ['patient' => $patient->id]);

    }
}
