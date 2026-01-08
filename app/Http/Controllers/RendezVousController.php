<?php

namespace App\Http\Controllers;

use App\Events\AddToListPatient;
use App\Events\CalendarDoctor;
use App\Events\ConsultationDone;
use App\Events\HeaderStatistiquesDoctor;
use App\Events\ListRendezVous;
use App\Models\RendezVous;
use App\Http\Requests\StoreRendezVousRequest;
use App\Http\Requests\UpdateRendezVousRequest;
use App\Http\Controllers\Request;
use App\Models\Docteur;
use App\Models\Patient;
use Inertia\Inertia;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = now()->startOfDay();
        $rendezvous = RendezVous::with('patient', 'docteur')
            ->whereDate('dateRendezVous', '>=', $today)
            ->get();
        return Inertia::render('Admin/RendezVous/Index', [
            'rendezvous' => $rendezvous,
        ]);
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
     * @param  \App\Http\Requests\StoreRendezVousRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRendezVousRequest $request)
    {
        // dd($request->patient_id);
        RendezVous::create([
            'dateRendezVous' => $request->dateRendezVous,
            'patient_id' => $request->patient_id,
            'user_id' => $request->docteur_id,
        ]);
        // event(new AddToListPatient());
        // event(new ListRendezVous());
        event(new HeaderStatistiquesDoctor());
        event(new ConsultationDone());
        // event(new CalendarDoctor());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RendezVous  $rendezVous
     * @return \Illuminate\Http\Response
     */
    public function show(RendezVous $rendezVous)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RendezVous  $rendezVous
     * @return \Illuminate\Http\Response
     */
    public function edit(RendezVous $rendezVous)
    {
        // $docteurs = Docteur::all();
        // $patients = Patient::all();
        // return Inertia::render(
        //     'Admin/RendezVous/Edit',
        //     [
        //         'docteurs' => $docteurs,
        //         'patients' => $patients
        //     ]
        // );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRendezVousRequest  $request
     * @param  \App\Models\RendezVous  $rendezVous
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRendezVousRequest $request, RendezVous $rendezVous)
    {
        $rendezVous->dateRendezVous = $request->dateRendezVous;
        $rendezVous->typeRendezVous = $request->typeRendezVous;
        $rendezVous->etatRendezVous = $request->etatRendezVous;
        $rendezVous->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RendezVous  $rendezVous
     * @return \Illuminate\Http\Response
     */
    public function destroy(RendezVous $rendezVous)
    {
        $rendezVous->delete();
    }

    public function deleteRendezVous($rendezvousId)
    {
        $rendezvous = RendezVous::find($rendezvousId);
        if ($rendezvous) {
            $rendezvous->delete();
        }
        event(new AddToListPatient());
        event(new HeaderStatistiquesDoctor());
        event(new ConsultationDone());
    }
}
