<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';
    protected $fillable = [

        'typeConsultation',
        'dateConsultation',
        'descriptionConsultation',
        'motifConsultation',
        'user_id',
        'patient_id',

    ];

    public function Docteur()
    {
        return $this->belongsTo(Docteur::class, 'user_id');
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function Analyse()
    {
        return $this->belongsToMany(Analyse::class, 'examens_consultations');
    }
    public function SousAnalyses()
    {
        return $this->belongsToMany(SousAnalyse::class, 'sous_analyses_consultations', 'consultation_id', 'sous_analyse_id');
    }

    public function Soins()
    {
        return $this->belongsToMany(Soin::class, 'soins_consultations');
    }
    public function Ordonnances()
    {
        return $this->hasMany(Ordonnance::class);
    }
    

    public function Factures()
    {
        return $this->belongsToMany(Facture::class, 'factures_consultations');
    }
    public function EchographiePelvienne()
    {
        return $this->hasOne(EchographiePelvienne::class);
    }
    public function EchographieDebutDeGrossesse()
    {
        return $this->hasOne(EchographieDebutGrossesse::class);
    }
    public function EchographiePremierTrimestre()
    {
        return $this->hasOne(EchographiePremierTrimestre::class);
    }
    public function EchographieDeuxiemeTrimestre()
    {
        return $this->hasOne(EchographieDeuxiemeTrimestre::class);
    }
    public function EchographiePremierTrimestreGem()
    {
        return $this->hasOne(EchographiePremierTrimestreGem::class);
    }
    public function EchographieDeuxiemeTrimestreGem()
    {
        return $this->hasOne(EchographieDeuxiemeTrimestreGem::class);
    }
    public function EchographieMammaire()
    {
        return $this->hasOne(EchographieMammaire::class);
    }
    public function EchographieNormale()
    {
        return $this->hasOne(EchographieNormale::class);
    }

    public function EchographieGynecologique()
    {
        return $this->hasOne(EchographieGynecologique::class);
    }

    public function Actes()
    {
        return $this->hasMany(Acte::class);
    }

    public function Echographies()
    {
        return $this->hasMany(Echographie::class);
    }

    protected static function booted()
    {
        static::deleting(function ($consultation) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $consultation->Analyse()->detach();
            $consultation->SousAnalyses()->detach();
            $consultation->Factures()->each(function ($facture) {
                $facture->Consultation()->detach();
                $facture->delete();
            });
            
            $consultation->Ordonnances()->each(function ($ordonnance) {
                $ordonnance->delete();
            });

            $consultation->Soins()->detach();

            $consultation->EchographiePelvienne()->delete();
            $consultation->EchographieDebutDeGrossesse()->delete();
            $consultation->EchographiePremierTrimestre()->delete();
            $consultation->EchographieDeuxiemeTrimestre()->delete();
            $consultation->EchographiePremierTrimestreGem()->delete();
            $consultation->EchographieDeuxiemeTrimestreGem()->delete();
            $consultation->EchographieMammaire()->delete();
            $consultation->EchographieNormale()->delete();
            $consultation->EchographieGynecologique()->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
}
