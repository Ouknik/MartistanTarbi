<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Parental\HasParent;

class Docteur extends User
{
    use HasParent;
    use HasFactory;


    // protected $table = 'docteurs';
    protected $appends = [
        'totalPatients', 'totalRendezVous', 'totalSalleAttente', 'totalConsultation', 'totalRevenu', 'TotalRevenuPermis'
    ];

    protected $fillable = [
        'name',
        'email',
        'adresse',
        'password'
        // 'telephone',
        // 'nom',
        // 'prenom'
    ];

    public function Consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function RendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patients_docteurs');
    }

    protected function gettotalPatientsAttribute()
    {
        return Patient::where('isActive', 1)->where('suiviPar', $this->id)->count();
    }

    protected function gettotalRendezVousAttribute()
    {
        $dateAujourdhui = Carbon::now()->toDateString();
        return $this->RendezVous()->where('dateRendezVous', $dateAujourdhui)->count();
    }

    protected function gettotalSalleAttenteAttribute()
    {
        return Patient::where('isActive', 1)->where('suiviPar', $this->id)->count();
    }
    

    protected function gettotalConsultationAttribute()
    {
        $dateAujourdhui = Carbon::now()->toDateString();
        return Consultation::whereRaw('YEAR(dateConsultation) = YEAR(?) AND MONTH(dateConsultation) = MONTH(?) AND DAY(dateConsultation) = DAY(?) AND user_id = ?', [$dateAujourdhui, $dateAujourdhui, $dateAujourdhui,$this->id])->count();
    }

    protected function gettotalRevenuAttribute()
    {
        $dateAujourdhui = Carbon::now()->toDateString();
        $docteur = $this->id; 
        $revenu =  PatientsPermis::where('dateVisite', $dateAujourdhui)->sum('montantPayer');
        $montantReglement =  ReglementFacture::where('dateReglement', $dateAujourdhui)->where('user_id', $docteur)->sum('montantReglement');
        return   $revenu + $montantReglement;
    }

    public function getTotalRevenuPermisAttribute()
    {
        $dateAujourdhui = Carbon::now()->toDateString();       
        $revenu =  PatientsPermis::where('dateVisite', $dateAujourdhui)->sum('montantPayer');
        return  $revenu;
      
    }


}
