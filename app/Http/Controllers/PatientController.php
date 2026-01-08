<?php

namespace App\Http\Controllers;

use App\Events\AddToListAtt;
use App\Events\AddToListPatient;
use App\Events\Antecedent as EventsAntecedent;
use App\Events\ConsultationDone;
use App\Events\Consultations;
use App\Events\DocteurEvent;
use App\Events\DocteurHeader;
use App\Events\HeaderStatistiquesDoctor;
use App\Events\ListRendezVous;
use App\Events\PatientEvent;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Antecedent;
use App\Models\Assurance;
use App\Models\Certificat;
use App\Models\Clinique;
use App\Models\Configuration;
use App\Models\Consultation;
use App\Models\Docteur;
use App\Models\Document;
use App\Models\Echographie;
use App\Models\EchographieDebutGrossesse;
use App\Models\EchographieDeuxiemeTrimestre;
use App\Models\EchographieDeuxiemeTrimestreGem;
use App\Models\EchographieMammaire;
use App\Models\EchographieNormale;
use App\Models\EchographiePelvienne;
use App\Models\EchographiePremierTrimestre;
use App\Models\EchographiePremierTrimestreGem;
use App\Models\Facture;
use App\Models\FamilleAnalyse;
use App\Models\Gestationnelle;
use App\Models\Medicament;
use App\Models\MotifVisite;
use App\Models\Ordonnance;
use App\Models\Patient;
use App\Models\ReglementFacture;
use App\Models\RendezVous;
use App\Models\Traitement;
use App\Models\typeOperation;
use App\Models\User;
use App\Models\Ville;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;




class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $dateAujourdhui = now()->toDateString();
        $formatedDate = now()->format('Y-m-d H:i:s');
        $query = $request->input('query');
        $queryParams = $request->only(['page', 'query']);
        $pageFromUrl = $queryParams['page'] ?? 1;
        if ($query) {
            $patients = $this->searchPatients($query, $dateAujourdhui, $pageFromUrl);
        } else {
            $patients = $this->getPatients($dateAujourdhui, 10, $pageFromUrl);
        }
        $villes = Cache::remember('villes', 60, fn () => Ville::all());
        $assurances = Cache::remember('assurances', 60, fn () => Assurance::all());
        $antecedents = Cache::remember('antecedents', 60, fn () => Antecedent::all());
        $motifVisite = Cache::remember('motifVisite', 60, fn () => MotifVisite::all());
        $cliniques = Cache::remember('cliniques', 60, fn () => Clinique::all());
        $typeOperations = Cache::remember('typeOperations', 60, fn () => typeOperation::all());
        $rendezVousToday = RendezVous::with('patient', 'docteur')->where('dateRendezVous', $dateAujourdhui)->get();

        return Inertia::render('Admin/Patients/Index', [
            'docteurs' => Docteur::all(),
            'antecedents' => $antecedents,
            'assurances' => $assurances,
            'villes' => $villes,
            'patients' => $patients,
            'patientsAtt' => $this->getAttendingPatients(),
            'visiteDone' => $this->getVisitsDone($dateAujourdhui),
            'formatedDate' => $formatedDate,
            //'rendezvous' => $this->getRendezvous(),
            'motifVisite' => $motifVisite,
            'cliniques' => $cliniques,
            'typeOperations' => $typeOperations,
            'rendezVousToday' => $rendezVousToday

        ]);
    }


    public function SortedAntecedents($antecedents)
    {
        return $antecedents->sortBy(function ($antecedent) {
            switch ($antecedent->typeAntecedent) {
                case 'valeur':
                    return 0;
                case 'true':
                    return 1;
                case 'text':
                    return 2;
                default:
                    return 3;
            }
        })->values();
    }

    private function getCachedData($modelClass, $minutes)
    {
        return Cache::remember($modelClass, $minutes, fn () => $modelClass::all());
    }

    public function getPatients($date, $perPage = 5)
    {
        return Patient::active()
            ->with(['factures', 'consultations.factures', 'ReglementFacture.docteur', 'RendezVous' => function ($query) use ($date) {
                $query->where('dateRendezVous', '>=', $date)->orderBy('dateRendezVous', 'asc')
                    ->with('docteur');
            }])

            ->paginate($perPage);
    }

    private function searchPatients($query, $dateAujourdhui)
    {
        $keywords = explode(' ', $query);
        return Patient::active()
            ->where(function ($patientQuery) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $patientQuery->where(function ($innerQuery) use ($keyword) {
                        $innerQuery->where('nomPatient', 'like', '%' . $keyword . '%')
                            ->orWhere('prenomPatient', 'like', '%' . $keyword . '%')
                            ->orWhere('cinPatient', 'like', '%' . $keyword . '%');
                    });
                }
            })
            ->with(['factures', 'consultations.factures', 'ReglementFacture.docteur', 'RendezVous' => function ($query) use ($dateAujourdhui) {
                $query->where('dateRendezVous', '>=', $dateAujourdhui)->orderBy('dateRendezVous', 'asc')->with('docteur');
            }])
            ->paginate(10);
    }

    private function getAttendingPatients()
    {
        return Patient::where('isActive', 1)
            ->orderByRaw("CASE WHEN statutPatient = 'Urgent' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'asc')
            ->latest()
            ->select('id', 'nomPatient', 'prenomPatient', 'statutPatient', 'sexePatient', 'suiviPar')
            ->get();
    }

    private function getRendezvous()
    {
        return RendezVous::with('patient', 'docteur')->get();
    }

    private function getVisitsDone($date)
    {
        return Consultation::with(['docteur', 'factures', 'patient.ReglementFacture', 'patient.RendezVous','patient.assurance'])
            ->whereDate('dateConsultation', $date)
            ->orderBy('created_at', 'desc')
            ->latest()
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $nationnalites = ['Marocaine', 'Française'];
        return Inertia::render(
            'Admin/Patients/Create',
            [
                'docteurs' => $this->getCachedData(Docteur::class, 60 * 24),
                'antecedents' => $$this->getCachedData(Antecedent::class, 60 * 24),
                'nationnalites' => $nationnalites,
                'villes' => $this->getCachedData(Ville::class, 60 * 24),
                'assurances' => Assurance::all(),
            ]
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatientRequest  $request
     *
     */
    public function store(StorePatientRequest $request)
    {
        $Date = new DateTime();
        $docteur = $request->docteur_id;
        $rendezVous = new RendezVous();
        $patient = Patient::create([
            'cinPatient' => $request->cinPatient,
            'nomPatient' => $request->nomPatient,
            'codePatient' => $request->codePatient1234,
            'prenomPatient' => $request->prenomPatient,
            'sexePatient' => $request->sexePatient,
            'villePatient' => $request->villePatient,
            'adressePatient' => $request->adressePatient,
            'telephonePatient' => $request->telephonePatient,
            'dateNaissancePatient' => $request->dateNaissancePatient,
            'nationalitePatient' => $request->nationalitePatient,
            'descriptionPatient' => $request->descriptionPatient,
            'assurance_id' => $request->assurance_id,
            'emailPatient' => $request->emailPatient,
            'statutPatient' => $request->statutPatient,
            'isActive' => $request->isActive,
            'conjointPatient' => $request->conjointPatient,
            'suiviPar' => $docteur,
            'groupeSanguinPatient' => $request->groupeSanguinPatient,
            'civilitePatient' => $request->civilitePatient,
        ]);
        if ($request->isActive == false && $request->dateRendezVous != null) {
            $rendezVous->dateRendezVous = $request->dateRendezVous;
            $rendezVous->patient_id = $patient->id;
            $rendezVous->user_id = $docteur;
            $rendezVous->save();
        } else {
            event(new AddToListAtt());
        }
        // dd($request->antecedents);
        if ($request->antecedents) {
            $antecedentA = new Antecedent();

            foreach ($request->antecedents as $antecedent) {
                $antecedentA->id = $antecedent['id'];
                if (isset($antecedent['valeurAntecedent'])) {
                    $patient->Antecedents()->sync([$antecedentA->id => ['valeurAntecedent' => $antecedent['valeurAntecedent']]], false);
                } else {
                    $patient->Antecedents()->sync([$antecedentA->id => ['valeurAntecedent' => '']], false);
                }
            }
        }

        if ($request->gestationnelle) {
            if ($request->gestationnelle['dateDernierRegle'] &&  $request->gestationnelle['dateGrossesse'] && $request->gestationnelle['dateAccouchement']) {
                Gestationnelle::create([
                    'dateDernierRegle' => $request->gestationnelle['dateDernierRegle'],
                    'dateGrosesse' => $request->gestationnelle['dateGrossesse'],
                    'dateAccouchement' => $request->gestationnelle['dateAccouchement'],
                    'patient_id' => $patient->id
                ]);
            }
        }
        $patient->Docteurs()->attach($docteur);
        event(new AddToListPatient());
        event(new AddToListAtt());
        return redirect()->route('patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     *
     */
    public function show(Patient $patient)
    {

        $assurances = DB::table('assurances')->get();
        $docteurs = Docteur::all();
        $villes = Ville::all();
        $assurance = Assurance::where('id', '=', $patient->assurance_id)->get();
        $motifVisite = Cache::remember('motifVisite', 60, fn () => MotifVisite::all());
        $antecedentsPatient = $patient->Antecedents()->get();
        $docteur = User::where('type', 'docteur')->first();
        // dd($docteur);
        // dd($antecedentsPatient);
        $soins = DB::table('soins')->get();
        $familleanalyses = FamilleAnalyse::with('analyses')->get();
        $sousAnalyses = DB::table('sous_analyses')->get();
        $dob   = \Carbon\Carbon::parse($patient->dateNaissancePatient);
        $now = \Carbon\Carbon::now();
        $age = $dob->diffInYears($now);
        // $medicaments = DB::table('medicaments')->get();
        $medicaments = Medicament::with('prescriptions')->get();
        $user = Auth::user();
        $traitements = Traitement::with('medicaments')->get();
        $ordonnances = Ordonnance::with('medicaments')->where('patient_id', '=', $patient->id)->get();
        $factures = Facture::where('patient_id', '=', $patient->id)->orderBy('dateFacture', 'desc')->get();
        $documents = Document::where('patient_id', '=', $patient->id)->get();
        $certificats = Certificat::where('patient_id', '=', $patient->id)->orderBy('created_at', 'desc')->get();
        $gestationnelle = Gestationnelle::where('patient_id', '=', $patient->id)->orderBy('created_at', 'desc')->limit(1)->get();
        $echographies = Echographie::where('patient_id', $patient->id)->orderBy('dateEcho', 'desc')->get();
        $Echographies = Consultation::with(
            'EchographieDebutDeGrossesse',
            'EchographiePelvienne',
            'EchographieDebutDeGrossesse',
            'EchographiePremierTrimestre',
            'EchographieDeuxiemeTrimestre',
            'EchographiePremierTrimestreGem',
            'EchographieDeuxiemeTrimestreGem',
            'EchographieMammaire',
            'EchographieNormale',
            'EchographieGynecologique',
            'Echographies'
        )->where('patient_id', '=', $patient->id)->get();

        $consultations = $Echographies;

        $echographieDebutDeGrossesse = [];
        $echographiePelvienne = [];
        $echographiePremierTrimestre = [];
        $echographieDeuxiemeTrimestre = [];
        $echographiePremierTrimestreGem = [];
        $echographieDeuxiemeTrimestreGem = [];
        $echographieMammaire = [];
        $echographieNormale = [];
        $echographieGynecologique = [];
        foreach ($consultations as $consultation) {

            if ($consultation->EchographieDebutDeGrossesse) {
                $echographieDebutDeGrossesse[] = $consultation->EchographieDebutDeGrossesse;
            }
            if ($consultation->EchographiePelvienne) {
                $echographiePelvienne[] = $consultation->EchographiePelvienne;
            }
            if ($consultation->EchographiePremierTrimestre) {
                $echographiePremierTrimestre[] = $consultation->EchographiePremierTrimestre;
            }
            if ($consultation->EchographieDeuxiemeTrimestre) {
                $echographieDeuxiemeTrimestre[] = $consultation->EchographieDeuxiemeTrimestre;
            }
            if ($consultation->EchographiePremierTrimestreGem) {
                $echographiePremierTrimestreGem[] = $consultation->EchographiePremierTrimestreGem;
            }
            if ($consultation->EchographieDeuxiemeTrimestreGem) {
                $echographieDeuxiemeTrimestreGem[] = $consultation->EchographieDeuxiemeTrimestreGem;
            }
            if ($consultation->EchographieMammaire) {
                $echographieMammaire[] = $consultation->EchographieMammaire;
            }
            if ($consultation->EchographieNormale) {
                $echographieNormale[] = $consultation->EchographieNormale;
            }
            if ($consultation->EchographieGynecologique) {
                $echographieGynecologique[] = $consultation->EchographieGynecologique;
            }
        }
        event(new PatientEvent($patient));
        // $patient= Patient::with('Antecedents')->where('id',,$patient->id)->get();
        // dd($patient);
        $latestConsultation = Consultation::where('patient_id', $patient->id)->latest()->first();
        return Inertia::render('Admin/Patients/Show', [
            'Echographies' => $echographies,
            'EchographieDG' => $echographieDebutDeGrossesse,
            'EchographieP' => $echographiePelvienne,
            'EchographiePT' => $echographiePremierTrimestre,
            'EchographieDT' => $echographieDeuxiemeTrimestre,
            'EchographiePTG' => $echographiePremierTrimestreGem,
            'EchographieDTG' => $echographieDeuxiemeTrimestreGem,
            'EchographieM' => $echographieMammaire,
            'EchographieN' => $echographieNormale,
            'EchographieG' => $echographieGynecologique,
            'patient' => $patient,
            'familleanalyses' => $familleanalyses,
            'soins' => $soins,
            'sousAnalyses' => $sousAnalyses,
            'consultations' => $this->getConsultations($patient),
            'antecedentsPatient' => $antecedentsPatient,
            'assurances' => $assurances,
            'assurance' => $assurance,
            'ordonnances' => $ordonnances,
            'certificats' => $certificats,
            'factures' => $factures,
            'documents' => $documents,
            'medicaments' => $medicaments,
            'age' => $age,
            'patientsAtt' => $this->getAttendingPatients(),
            'user' => $user,
            'gestationnelle' => $gestationnelle,
            'traitements' => $traitements,
            'docteurs' => $docteurs,
            'villes' => $villes,
            'motifVisite' => $motifVisite,
            'latestConsultation' => $latestConsultation,
            'docteur' => $docteur
        ]);
    }

    public function getConsultations($patient)
    {
        return Consultation::with(
            'Analyse',
            'SousAnalyses',
            'soins',
            'factures',
            'Echographies',
            'ordonnances.medicaments',
            'EchographiePelvienne',
            'EchographieDebutDeGrossesse',
            'EchographiePremierTrimestre',
            'EchographieDeuxiemeTrimestre',
            'EchographiePremierTrimestreGem',
            'EchographieDeuxiemeTrimestreGem',
            'EchographieMammaire',
            'EchographieNormale',
            'EchographieGynecologique'
        )->where('patient_id', '=', $patient->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     *
     */
    public function edit(Patient $patient)
    {
        return Inertia::render(
            'Admin/Patients/Edit',
            [
                'patient' => $patient
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  \App\Models\Patient  $patient
     *
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->cinPatient = $request->cinPatient;
        $patient->nomPatient = $request->nomPatient;
        $patient->codePatient = $request->codePatient;
        $patient->prenomPatient = $request->prenomPatient;
        $patient->sexePatient = $request->sexePatient;
        $patient->civilitePatient = $request->civilitePatient;
        $patient->adressePatient = $request->adressePatient;
        $patient->telephonePatient = $request->telephonePatient;
        $patient->dateNaissancePatient = $request->dateNaissancePatient;
        $patient->nationalitePatient = $request->nationalitePatient;
        $patient->descriptionPatient = $request->descriptionPatient;
        $patient->emailPatient = $request->emailPatient;
        $patient->statutPatient = $request->statutPatient;
        $patient->assurance_id = $request->assurance_id;
        $patient->conjointPatient = $request->conjointPatient;
        $patient->villePatient = $request->villePatient;
        $patient->groupeSanguinPatient = $request->groupeSanguinPatient;
        $patient->save();
        event(new AddToListAtt());
        event(new PatientEvent($patient));
        return redirect()->back();
    }

    public function updateActive(Patient $patient, $docteur, $statutPatient)
    {
        if ($patient->isActive == 1) {
            $patient->isActive = 0;
        } else {
            $patient->isActive = 1;
        }

        $patient->created_at = now();
        $patient->suiviPar = $docteur;
        $patient->statutPatient = $statutPatient;

        $patient->updateOrFail(['isActive', 'created_at', 'suiviPar', 'statutPatient']);
        event(new AddToListAtt());
        event(new HeaderStatistiquesDoctor());
        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     *
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return Redirect::route('patients.index');
    }


    public function getOrdonnances(\Illuminate\Http\Request $consultation)
    {
        $consultations = Consultation::with("factures", "ordonnances.medicaments", "Echographies", 'EchographiePelvienne', 'EchographieDebutDeGrossesse', 'EchographiePremierTrimestre', 'EchographieDeuxiemeTrimestre', 'EchographiePremierTrimestreGem', 'EchographieDeuxiemeTrimestreGem', 'EchographieMammaire', 'EchographieNormale', 'EchographieGynecologique')->where('id', '=', $consultation->id)->get();
        return Inertia::render('Admin/Patients/Show', [
            'patient' => Patient::find($consultation->patient_id),
            'ordonnanceConslt' => $consultations[0],
        ]);
    }
}
