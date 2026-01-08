<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $fillable = [
        'cinPatient',
        'nomPatient',
        'codePatient',
        'villePatient',
        'prenomPatient',
        'sexePatient',
        'adressePatient',
        'telephonePatient',
        'emailPatient',
        'dateNaissancePatient',
        'nationalitePatient',
        'descriptionPatient',
        'assurance_id',
        'statutPatient',
        'isActive',
        'suiviPar',
        'conjointPatient',
        'groupeSanguinPatient',
        'civilitePatient',
        'TotalByDoctor'
    ];
    protected $appends = [
        'totalFactures', 'totalReglements', 'TotalByDoctor', 'TotalByDoctorToDay',
        'TotalFacturesToDay', 'TotalReglementsToDay', 'RendezVous', 'AGGSS'
    ];
    public function Gestationnelles()
    {
        return $this->hasMany(Gestationnelle::class);
    }

    protected function getAGGSSAttribute()
    {
        $lastGestationnelle = $this->Gestationnelles()->latest()->first();
        $SA = '';
        if ($lastGestationnelle) {
            $dateAccouchement = $lastGestationnelle->dateAccouchement;
            $dateAccouchementTime = new DateTime($dateAccouchement);
            $currentDateTime = new DateTime();

            if ($currentDateTime < $dateAccouchementTime) {
                $lastRuleDate = $lastGestationnelle->dateDernierRegle;
                $lastRuleDateTime = new DateTime($lastRuleDate);
                $currentDateTime = new DateTime();
                // Calcul de la différence totale en jours
                $interval = $lastRuleDateTime->diff($currentDateTime);
                $totalDaysDifference = $interval->days;
                // Calcul du nombre de semaines
                $weeksDifference = intval($totalDaysDifference / 7);
                // Calcul du nombre de jours restants après la soustraction des semaines
                $remainingDays = $totalDaysDifference % 7;
                $weeksDifferenceFormatted = ($weeksDifference < 10) ? sprintf("%02d", $weeksDifference) : $weeksDifference;
                $SA = $weeksDifferenceFormatted . ' SA';
                if ($remainingDays > 0) {
                    // Calculer la prochaine semaine et formater le nombre
                    $nextWeek = $weeksDifference + 1;
                    $nextWeekFormatted = ($nextWeek < 10) ? sprintf("%02d", $nextWeek) : $nextWeek;

                    $SA = $weeksDifferenceFormatted . '-' . $nextWeekFormatted . ' SA';
                }
            }
        }
        return $SA;
    }

    public function Antecedents()
    {
        return $this->belongsToMany(Antecedent::class, "patients_antecedents")->withPivot('valeurAntecedent', 'descriptientAntecedent');
    }
    public function Consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function Echographies()
    {
        return $this->hasMany(Echographie::class);
    }
    public function scopeActive($query)
    {
        return $query->where('isActive', 0);
    }

    protected function getTotalFacturesAttribute()
    {
        return $this->factures()->sum('montantFacture');
    }

    protected function getTotalReglementsAttribute()
    {
        return $this->ReglementFacture()->sum('montantReglement');
    }

    public function getTotalFacturesToDayAttribute()
    {
        return $this->factures()
            ->whereDate('dateFacture', now()->toDateString())
            ->sum('montantFacture');
    }

    public function getTotalReglementsToDayAttribute()
    {
        return $this->ReglementFacture()
            ->whereDate('dateReglement', now()->toDateString())
            ->sum('montantReglement');
    }


    protected function getTotalByDoctorAttribute()
    {
        $consultations = $this->with(['Consultations' => function ($query) {
            $query->with('Factures', 'Docteur');
        }])->find($this->id)->Consultations;
        $reglements = $this->ReglementFacture;
        $totalsByDoctor = [];
        foreach ($consultations as $consultation) {
            $doctorId = $consultation->user_id;
            $doctorName = $consultation->Docteur->name;
            $total = $consultation->Factures->sum('montantFacture');
            if (!isset($totalsByDoctor[$doctorId])) {
                $totalsByDoctor[$doctorId] = [
                    'id' => $doctorId,
                    'nom' => $doctorName,
                    'total_factures' => 0,
                    'total_reglements' => 0
                ];
            }
            $totalsByDoctor[$doctorId]['total_factures'] += $total;
        }
        foreach ($reglements as $reglement) {
            $doctorId = $reglement->user_id;
            if (!isset($totalsByDoctor[$doctorId])) {
                $totalsByDoctor[$doctorId] = [
                    'id' => $doctorId,
                    'nom' => $reglement->docteur->name,
                    'total_factures' => 0,
                    'total_reglements' => 0
                ];
            }
            $totalsByDoctor[$doctorId]['total_reglements'] += $reglement->montantReglement;
        }
        return array_values($totalsByDoctor);
    }

    protected function getTotalByDoctorToDayAttribute()
    {
        $today = now()->format('Y-m-d');
        $consultations = $this->with(['Consultations' => function ($query) use ($today) {
            $query->with(['Factures' => function ($query) use ($today) {
                $query->whereDate('dateFacture', $today);
            }, 'Docteur']);
        }])->find($this->id)->Consultations;
        $reglements = $this->ReglementFacture->where('dateReglement', $today);
        $totalsByDoctor = [];
        foreach ($consultations as $consultation) {
            $doctorId = $consultation->user_id;
            $doctorName = $consultation->Docteur->name;
            $total = $consultation->Factures->sum('montantFacture');
            if (!isset($totalsByDoctor[$doctorId])) {
                $totalsByDoctor[$doctorId] = [
                    'id' => $doctorId,
                    'nom' => $doctorName,
                    'total_factures' => 0,
                    'total_reglements' => 0
                ];
            }
            $totalsByDoctor[$doctorId]['total_factures'] += $total;
        }
        foreach ($reglements as $reglement) {
            $doctorId = $reglement->user_id;
            if (!isset($totalsByDoctor[$doctorId])) {
                $totalsByDoctor[$doctorId] = [
                    'id' => $doctorId,
                    'nom' => $reglement->docteur->name,
                    'total_factures' => 0,
                    'total_reglements' => 0
                ];
            }
            $totalsByDoctor[$doctorId]['total_reglements'] += $reglement->montantReglement;
        }
        return array_values($totalsByDoctor);
    }
    protected function getRendezVousAttribute()
    {
        return $this->RendezVous()->with('Docteur')->orderBy('dateRendezVous', 'asc')->get();
    }
    public function RendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
    public function Docteurs()
    {
        return $this->belongsToMany(Docteur::class, 'patients_docteurs');
    }

    public function Assurance()
    {
        return $this->belongsTo(Assurance::class);
    }

    public function Factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function PatientsPermis()
    {
        return $this->hasMany(PatientsPermis::class);
    }

    public function Ordonnances()
    {
        return $this->hasMany(Ordonnance::class);
    }

    public function Documents()
    {
        return $this->hasMany(Document::class);
    }
    public function Certificats()
    {
        return $this->hasMany(Certificat::class);
    }
    public function OperationPatients()
    {
        return $this->hasMany(OperationPatient::class);
    }

    public function ReglementFacture()
    {
        return $this->hasMany(ReglementFacture::class);
    }
    public function EchographieDebutGrossesses()
    {
        return $this->hasMany(EchographieDebutGrossesse::class);
    }
    protected static function booted()
    {
        static::deleting(function ($patient) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $patient->RendezVous()->delete();
            $patient->Docteurs()->detach();
            $patient->Factures()->each(function ($facture) {
                $facture->Consultation()->detach();
            });
            $patient->Factures()->delete();
            $patient->Consultations()->each(function ($consultation) {
                $consultation->Soins()->detach();
                $consultation->Ordonnances()->each(function ($ordonnance) {
                    $ordonnance->Medicaments()->detach();
                });
                $consultation->Ordonnances()->delete();
                $consultation->Analyse()->detach();
            });
            $patient->Consultations()->delete();
            $patient->Ordonnances()->delete();
            $patient->Documents()->delete();
            $patient->Antecedents()->detach();
            $patient->Certificats()->delete();
            $patient->Gestationnelles()->delete();
            $patient->OperationPatients()->delete();
            $patient->ReglementFacture()->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
}
