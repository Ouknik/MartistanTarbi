<?php

namespace App\Http\Controllers;

use App\Charts\AssuranceChart;
use App\Charts\MontantDoctorChart;
use App\Charts\MonthlyDoctorChart;
use App\Charts\RevenuAH;
use App\Models\Docteur;
use App\Http\Requests\StoreDocteurRequest;
use App\Http\Requests\UpdateDocteurRequest;
use App\Models\Antecedent;
use App\Models\Assurance;
use App\Models\Clinique;
use App\Models\Consultation;
use App\Models\Facture;
use App\Models\FamilleAnalyse;
use App\Models\Medicament;
use App\Models\MotifVisite;
use App\Models\OperationPatient;
use App\Models\Patient;
use App\Models\ReglementFacture;
use App\Models\ReglementOperation;
use App\Models\Soin;
use App\Models\Traitement;
use App\Models\typeOperation;
use App\Models\Ville;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DocteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $docteurs = Docteur::with('consultations')->get();
        return Inertia::render('Admin/Docteurs/Index', [
            'docteurs' => $docteurs,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $specialites = Docteur::select('docteur_id', 'specialiteDocteur')->get();
        return Inertia::render(
            'Admin/Docteur/Create',
            [
                'specialites' => $specialites,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocteurRequest  $request
     *
     */
    public function store(StoreDocteurRequest $request)
    {
        Docteur::create([
            'nomDocteur' => $request->nomDocteur,
            'prenomDocteur' => $request->prenomDocteur,
            'adresseDocteur' => $request->adresseDocteur,
            'telephoneDocteur' => $request->telephoneDocteur,
            'specialiteDocteur' => $request->specialiteDocteur,
            'codeDocteur' => $request->codeDocteur,
            'sexeDocteur' => $request->sexeDocteur,
            'villeDocteur' => $request->villeDocteur,
            'emailDocteur' => $request->emailDocteur,
            'departementDocteur' => $request->departementDocteur,
            'dateNaissanceDocteur' => $request->dateNaissanceDocteur,
            'nationaliteDocteur' => $request->nationaliteDocteur,
            'descriptionDocteur' => $request->descriptionDocteur,
        ]);
        return redirect()->route('docteurs.index')->with('message', ' Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docteur  $docteur
     *
     */
    public function show(Docteur $docteur)
    {

        $consultations = Consultation::where('user_id', '=', $docteur->id)->orderBy('dateConsultation', 'desc')->get();
        $counterConsultation = $consultations->count();
        $totalCabinet = ReglementFacture::where('user_id', $docteur->id)->sum('montantReglement');
        $patients = DB::table('patients')
            ->where('patients.suiviPar', '=', $docteur->id)->get();
        $counterPatients = $patients->count();
        return Inertia::render('Admin/Docteurs/Show', [
            'docteur' => $docteur,
            'consultations' => $consultations,
            'counterConsultation' => $counterConsultation,
            'counterPatients' => $counterPatients,
            'patients' => $patients,
            'totalCabinet' => $totalCabinet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docteur  $docteur
     *
     */
    public function edit(Docteur $docteur)
    {
        return Inertia::render(
            'Admin/Docteurs/Edit',
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocteurRequest  $request
     * @param  \App\Models\Docteur  $docteur
     *
     */
    public function update(UpdateDocteurRequest $request, Docteur $docteur)
    {
        $docteur->nomDocteur =  $request->nomDocteur;
        $docteur->prenomDocteur = $request->prenomDocteur;
        $docteur->adresseDocteur = $request->adresseDocteur;
        $docteur->telephoneDocteur = $request->telephoneDocteur;
        $docteur->specialiteDocteur = $request->specialiteDocteur;
        $docteur->codeDocteur =  $request->codeDocteur;
        $docteur->sexeDocteur =  $request->sexeDocteur;
        $docteur->villeDocteur =  $request->villeDocteur;
        $docteur->emailDocteur =  $request->emailDocteur;
        $docteur->departementDocteur =  $request->departementDocteur;
        $docteur->dateNaissanceDocteur =  $request->dateNaissanceDocteur;
        $docteur->nationaliteDocteur =  $request->nationaliteDocteur;
        $docteur->descriptionDocteur =  $request->descriptionDocteur;
        $docteur->profile_photo_path =  $request->profile_photo_path;
        $docteur->save();
        return redirect()->route('docteur.index')->with('message', 'Docteur Modifier avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docteur  $docteur
     *
     */
    public function destroy(Docteur $docteur)
    {
        $docteur->delete();
        return redirect()->route('docteur.index')->with('message', 'docteur supprimer avec succés');
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    public function parametrage()
    {
        $assurances = Assurance::all();
        $soins = Soin::all();
        $antecedents = Antecedent::all();
        $traitements = Traitement::with('medicaments')->get();
        $medicaments = Medicament::with('prescriptions')->get();
        $cliniques = Clinique::all();
        $villes = Ville::orderBy('nomVille', 'asc')->get();
        $analyses = FamilleAnalyse::all();
        $motifVisite = MotifVisite::all();
        $typeOperations = typeOperation::all();
        return Inertia::render('Admin/Parametrage/Index', [
            'medicaments' => $medicaments,
            'assurances' => $assurances,
            'soins' => $soins,
            'traitements' => $traitements,
            'antecedents' => $antecedents,
            'cliniques' => $cliniques,
            'villes' => $villes,
            'analyses' => $analyses,
            'motifVisite' => $motifVisite,
            'typeOperations' => $typeOperations

        ]);
    }

    public function getCachedData($modelClass, $minutes)
    {
        return Cache::remember($modelClass, $minutes, fn () => $modelClass::all());
    }

    public function statistique()
    {
        $nomAssurance = Assurance::select()->get();
        $countAssurance = Patient::select()->get();
        $nomAssuranceR = [];
        $countAssurance = [];

        foreach ($nomAssurance as $assurance) {
            $nomAssuranceR[] = $assurance->typeAssurance;
            $countAssurance[] = Patient::where('assurance_id', $assurance->id)->count();
        }

        $docteurId = Auth::user()->id;
        Carbon::setLocale('fr');

        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subMonths(11)->startOfMonth();
        $endDate = $currentDate->copy()->endOfMonth();

        $monthlyInvoices = collect();
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addMonth()) {
            $monthYear = $date->isoFormat('MMMM YYYY');
            $monthlyInvoices[$monthYear] = 0;
        }

        // Use formatted dates for the query
        $formattedStartDate = $startDate->format('Y-m-d');
        $formattedEndDate = $endDate->format('Y-m-d');

        $reglements = ReglementFacture::where('user_id', $docteurId)
            ->whereBetween('dateReglement', [$formattedStartDate, $formattedEndDate])
            ->get();
        // dd($reglements);
        foreach ($reglements as $reglement) {
            $monthYear = Carbon::parse($reglement->dateReglement)->isoFormat('MMMM YYYY');
            $monthlyInvoices[$monthYear] += $reglement->montantReglement;
        }
        //    bloc Operations

        // Initialize monthly invoices for operations
        $monthlyInvoicesOperations = collect();
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addMonth()) {
            $monthYear = $date->isoFormat('MMMM YYYY');
            $monthlyInvoicesOperations[$monthYear] = 0;
        }

        // Fetch ReglementOperation data
        $reglementsOperations = ReglementOperation::where('user_id', $docteurId)
            ->whereBetween('dateReglement', [$formattedStartDate, $formattedEndDate])
            ->get();

        // Aggregate the operation amounts by month
        foreach ($reglementsOperations as $operation) {
            $monthYear = Carbon::parse($operation->dateReglement)->isoFormat('MMMM YYYY');
            $monthlyInvoicesOperations[$monthYear] += $operation->montantReglement;
        }

        return Inertia::render('Admin/Statistiques/Index', [
            'nomAssuranceR' => $nomAssuranceR,
            'countAssurance' => $countAssurance,
            'invoiceMonths' => array_keys($monthlyInvoices->toArray()),
            'invoiceAmountsPerMonth' => array_values($monthlyInvoices->toArray()),
            //Bloc Operatoire
            'invoiceMonthsOperation' => array_keys($monthlyInvoicesOperations->toArray()),
            'invoiceAmountsPerMonthOperation' => array_values($monthlyInvoicesOperations->toArray())
        ]);
    }

    public function dashboard(RevenuAH $chartAH)
    {
        $docteurs = Docteur::all();
        $docteur = Auth::user();
        $dateNow = Carbon::now()->toDateString();
        $dateYesterday = Carbon::now()->subDay()->toDateString();

        $patientsAtt = Patient::with('rendezVous')
            ->where('isActive', 1)
            ->orderByRaw("CASE WHEN statutPatient = 'Urgent' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'asc')
            ->get();

        $operationsToday = OperationPatient::whereDate('dateOperation', Carbon::today())
            ->join('patients', 'operation_patients.patient_id', '=', 'patients.id')
            ->join('cliniques', 'operation_patients.clinique_id', '=', 'cliniques.id')
            ->select('operation_patients.dateOperation', 'operation_patients.nomOperation', 'operation_patients.descriptionOperation', 'patients.nomPatient', 'patients.prenomPatient', 'cliniques.nomClinique')
            ->get();
        $operationsYesterday = OperationPatient::whereDate('dateOperation', Carbon::yesterday())
            ->join('patients', 'operation_patients.patient_id', '=', 'patients.id')
            ->join('cliniques', 'operation_patients.clinique_id', '=', 'cliniques.id')
            ->select('operation_patients.dateOperation', 'operation_patients.nomOperation', 'operation_patients.descriptionOperation', 'patients.nomPatient', 'patients.prenomPatient', 'cliniques.nomClinique')
            ->get();

        return Inertia::render(
            'Admin/Docteurs/Dashboard',
            [

                'patientsAtt' => $patientsAtt,
                'docteurs' => $docteurs,

                'countConsultationToday' => $this->getNombrePatient($dateNow, $docteur),
                'countConsultationYesterday' => $this->getNombrePatient($dateYesterday, $docteur),

                'montantTotalAssureToday' => $this->getNombreMutuelle($dateNow, $docteur, '!='),
                'montantTotalAssureYesterday' => $this->getNombreMutuelle($dateYesterday, $docteur, '!='),

                'montantTotalNonAssureToday' => $this->getNombreMutuelle($dateNow, $docteur, '='),
                'montantTotalNonAssureYesterday' => $this->getNombreMutuelle($dateYesterday, $docteur, '='),

                'montantTotalYesterday' => $this->getTotalRevenu($dateYesterday, $docteur),
                'montantTotalToday' => $this->getTotalRevenu($dateNow, $docteur),

                'operationsToday' => $operationsToday,
                'operationsYesterday' => $operationsYesterday,

            ]
        );
    }
    public function caisse(Request $request)
    {
        $docteurs = Docteur::all();
        $assurances = Assurance::all();
        $typeOperations = typeOperation::all();
        $cliniques = Clinique::all();

        $choix = $request->input('choix');

        $dateDebut = $request->input('dateDebut');
        $dateFin = $request->input('dateFin');
        $docteur = $request->input('docteur');
        $assurance = $request->input('assurance');
        $operation = $request->input('typeOperation');
        $clinique = $request->input('clinique');
        // dd($clinique);
        // Filter Bloc Operatoire
        $query = '';

        if (!$dateDebut && !$dateFin && !$docteur && !$assurance) {
            $caisse = collect([]);
        } else {
            if ($choix == 'Cabinet') {
                $query = ReglementFacture::with('patient', 'docteur');
                if ($docteur) {
                    $query->where('user_id', $docteur);
                }
                if ($dateDebut && $dateFin) {
                    $query->whereBetween('dateReglement', [$dateDebut, $dateFin]);
                }
            } else {
                $query = OperationPatient::with('clinique', 'patient');
                if ($dateDebut && $dateFin) {
                    $query->whereBetween('dateOperation', [$dateDebut, $dateFin]);
                }
                if ($operation && $operation != 'Tous') {
                    $query->where('nomOperation', [$operation]);
                }
                if ($clinique && $clinique != 'Tous') {
                    $query->where('clinique_id', [$clinique]);
                }
            }

            if ($assurance && $assurance != 'Tous') {
                $query->where('typeAssurance', [$assurance]);
            }
            $caisse = $query->get();
        }

        return Inertia::render('Admin/Caisse/Index', [
            'typeOperations' => $typeOperations,
            'docteurs' => $docteurs,
            'caisse' => $caisse,
            'assurances' => $assurances,
            'cliniques' => $cliniques,
            'choixRequet' => $choix,
        ]);
    }


    public function reglages()
    {
        return Inertia::render('Admin/Reglages/Index', []);
    }

    public function dents()
    {
        return Inertia::render(
            'Admin/Dents/Index',
            []
        );
    }


    public function getNombrePatient($date, $docteur)
    {
        return Consultation::whereRaw('YEAR(dateConsultation) = YEAR(?) AND MONTH(dateConsultation) = MONTH(?) AND DAY(dateConsultation) = DAY(?) AND user_id = ?', [$date, $date, $date, $docteur->id])->count();
    }

    public function getNombreMutuelle($date, $docteur, $operateur)
    {
        return ReglementFacture::where('typeAssurance', $operateur, 'Non Assuré')
            ->where('user_id', $docteur->id)
            ->whereDate('dateReglement', $date)
            ->sum('montantReglement');
    }

    public function getTotalRevenu($date, $docteur)
    {
        return ReglementFacture::where('user_id', $docteur->id)
            ->whereDate('dateReglement', $date)
            ->sum('montantReglement');
    }
}
