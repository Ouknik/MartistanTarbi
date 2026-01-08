<?php

namespace App\Http\Controllers;

use App\Events\AddToListAtt;
use App\Events\AddToListPatient;
use App\Events\ConsultationDone;
use App\Events\HeaderStatistiquesDoctor;
use App\Models\Consultation;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Analyse;
use App\Models\Antecedent;
use App\Models\Docteur;
use App\Models\Examen;
use App\Models\Facture;
use App\Models\Ordonnance;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\RendezVous;
use App\Models\Soin;
use App\Models\SousAnalyse;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Utils\NumberToWordsFrench;
use Illuminate\Support\Facades\Redirect;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultations = Consultation::with('docteurs', 'patients')->get();
        return Inertia::render('Admin/Consultations/Index', [
            'consultations' => $consultations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docteurs = User::all();
        $patients = Patient::all();
        $factures = Facture::all();
        return Inertia::render([
            'docteurs' => $docteurs,
            'patients' => $patients,
            'factures' => $factures
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConsultationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsultationRequest $request)
    {
        $docteur = User::where('type', 'docteur')->first();
        $patientID = $request->ordonnances['patient']['id'];
        $patient = $request->ordonnances['patient'];
        $dateConsultation = $request->dateConsultation;

        //Creer Consultation
        $consult =  Consultation::create([
            'dateConsultation' => $dateConsultation,
            'descriptionConsultation' => $request->diagnostiqueConsultation,
            'motifConsultation' => $request->motifConsultation,
            'patient_id' => $patientID,
            'user_id' => $docteur->id,
        ]);

        if ($request->soins) {
            if ($request->soins) {
                $soinsFacture = json_encode($request->soins);
            }

            $facture = new Facture();
            $facture->dateFacture = $dateConsultation;
            $facture->tvaFacture = 20;

            if ($request->montantApayer) {
                $facture->montantFacture = $request->montantApayer;
                $montantLettre = NumberToWordsFrench::convert($request->montantApayer);
            } else {
                $facture->montantFacture = $request->total;
                $montantLettre = NumberToWordsFrench::convert($request->total);
            }
            $facture->patient_id = $patientID;
            $facture->montantLettre = $montantLettre;
            $facture->paiement_id = 1;
            $facture->soins = $soinsFacture;
            $facture->save();
            $consult->Factures()->attach($facture);
            //Save Soins
            foreach ($request->soins as $soin) {
                $soinC = new Soin();
                $soinC->id = $soin['id'];
                $soi = Soin::find($soinC->id);
                $consult->Soins()->attach($soi);
            }
            //Save ANALYSES
            if ($request->analyses) {
                foreach ($request->analyses as $analyse) {
                    $examen = new Analyse();
                    $examen->id = $analyse['id'];
                    $examen->nomAnalyse = $analyse['nomAnalyse'];
                    $exam = Analyse::firstOrCreate(['nomAnalyse' => $examen->nomAnalyse]);
                    $consult->Analyse()->attach($exam);
                }
            }

            //Save SOUSANALYSES
            $sousA = null;
            // dd($request->SousAnalyses);
            foreach ($request->SousAnalyses as $SousAnalyse) {
                $sousAnaly = new SousAnalyse();
                $sousAnaly->id = $SousAnalyse['id'];
                $sousAnaly->nomSousAnalyse = $SousAnalyse['nomSousAnalyse'];
                $sousA = SousAnalyse::firstOrCreate(['id' => $sousAnaly->id, 'nomSousAnalyse' => $sousAnaly->nomSousAnalyse]);
                if ($sousA != null) {
                    $consult->SousAnalyses()->attach($sousA);
                }
            }

            // Save Antecedents
            $patient = Patient::findOrFail($patientID);
            $patient->isActive = 0;
            $patient->updateOrFail(['isActive']);
            foreach ($request->antecedents as $antecedent) {
                $antecedentA = new Antecedent();
                $antecedentA->id = $antecedent['id'];
                $patient->Antecedents()->sync([$antecedentA->id => ['valeurAntecedent' => $antecedent['pivot']['valeurAntecedent']]], false);
            }
            // Create New Ordonnace
            $ordonnance = new Ordonnance();
            $ordonnance->dateOrdonnance = $dateConsultation;
            $ordonnance->consultation_id = $consult->id;
            $ordonnance->patient_id = $patientID;
            $ordonnance->user_id = $docteur->id;
            $ordonnance->save();
            if ($request->ordonnances['traitementsChoisi']) {
                $this->InsertMedicamentPrescription($request->ordonnances['traitementsChoisi'], 'normal', $ordonnance);
            }
            if ($request->RendezVousDate != null) {
                RendezVous::create([
                    'dateRendezVous' => $request->RendezVousDate,
                    'patient_id' => $patientID,
                    'user_id' => $docteur->id,
                ]);
            }
            event(new AddToListAtt);
            // event(new AddToListPatient);
            event(new ConsultationDone);
            event(new HeaderStatistiquesDoctor);
        }
    }





    public function InsertMedicamentPrescription($medicaments, $type, $ordonnance)
    {
        foreach ($medicaments as $medicament) {
            $prescription = $medicament['prescription'];
            $medicamentId  = $medicament['medicament_id'];
            $ordonnance->Medicaments()->attach($medicamentId, ['prescription' => $prescription, 'typeOrdonnance' => $type]);
            if (isset($medicament['isChecked']) && $medicament['isChecked']) {
                Prescription::create([
                    'prescription' => $prescription,
                    'medicament_id' => $medicamentId
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        $consultations = Consultation::with('docteurs', 'patients')->get();
        return Inertia::render(
            'Admin/Consultations/Show',
            [
                'consultations' => $consultations
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConsultationRequest  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        $consultation->motifConsultation = $request->motifConsultation;
        $consultation->descriptionConsultation = $request->descriptionConsultation;
        $consultation->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        event(new HeaderStatistiquesDoctor);
        return redirect()->back();
    }
}
