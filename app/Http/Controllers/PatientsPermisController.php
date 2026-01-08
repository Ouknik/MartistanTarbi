<?php

namespace App\Http\Controllers;

use App\Events\AddToListAtt;
use App\Events\AddToListPatient;
use App\Events\ConsultationDone;
use App\Events\HeaderStatistiquesDoctor;
use App\Models\PatientsPermis;
use App\Http\Requests\StorePatientsPermisRequest;
use App\Http\Requests\UpdatePatientsPermisRequest;
use App\Models\Docteur;
use App\Models\Patient;
use App\Models\PermisDossierNumber;
use App\Models\ReglementFacture;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PatientsPermisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientsPermis = PatientsPermis::with('patient')
            ->orderBy('created_at', 'desc')
            ->get();
        $docteurs = Docteur::all();
        // dd($patientsPermis);
        return Inertia::render('Admin/Permis/Index', [
            'patientsPermis' => $patientsPermis,
            'docteurs' => $docteurs,
            'patientsAtt' => $this->getAttendingPatients(),
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
            'Admin/Permis/Create',
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientsPermisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientsPermisRequest $request)
    {
        //  dd($request->patient_id);
        $dossierNumber = $request->code;
        $date = date('Y-m-d');

        // $existingDossierNumber = PermisDossierNumber::where('dossier_number', '=', $dossierNumber)->get();

        // if ($existingDossierNumber) {
        //     $permisDossierNumber = new PermisDossierNumber;
        //     $permisDossierNumber->dossier_number = $dossierNumber;
        //     $permisDossierNumber->save();
        // }
        PatientsPermis::create([
            'numeroDossier' => $dossierNumber,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'dateNaissance' => $request->dateNaissance,
            'genre' => $request->genre,
            'dateVisite' => $date,
            'montantAPayer' => $request->montantAPayer,
            'patient_id' => $request->patient_id,
            'montantPayer' => 0,
        ]);
        event(new AddToListAtt);
        // event(new AddToListPatient);
        // event(new ConsultationDone);
        event(new HeaderStatistiquesDoctor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientsPermis  $patientsPermis
     * @return \Illuminate\Http\Response
     */
    public function show(PatientsPermis $patientsPermis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientsPermis  $patientsPermis
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientsPermis $patientsPermis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientsPermisRequest  $request
     * @param  \App\Models\PatientsPermis  $patientsPermis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientsPermisRequest $request, PatientsPermis $patientsPermis)
    {

        // dd($request);
        $patientPermis = PatientsPermis::find($request->idPatientPermis);
        // $patientPermis->update($request->all());
        // $montantPayer =  $request->montantReglement;
        $patientPermis->montantPayer = $request->montantReglement;
        $patientPermis->save();
        event(new HeaderStatistiquesDoctor);
        // dd($patientPermis);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientsPermis  $patientsPermis
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientsPermis $patientsPermis)
    {
        //
    }

    private function getAttendingPatients()
    {
        return Patient::where('isActive', 1)
            ->where('statutPatient', 'Permis')
            ->with('rendezVous')
            ->orderBy('created_at', 'desc')
            ->latest()
            ->get();
    }
}
