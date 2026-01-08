<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographiePremierTrimestre extends Model
{
    use HasFactory;

    protected $table = 'echographie_premier_trimestres';

    protected $fillable = [
        'date',
        'indication',
        'uterus',
        'oeufUnique',
        'aspect',
        'vesicule_ombilicale',
        'embryonUnique',
        'activite_cardiaque',
        'mouvements_actifs',
        'clarte_nucale',
        'long_cranio_caudale',
        'diametre_biparietal',
        'long_cranio_caudaleSoitSemaines',
        'long_cranio_caudaleSoitJours',
        'diametre_biparietalSoitSemaines',
        'diametre_biparietalSoitJours',
        'annexe_gauche',
        'annexe_droite',
        'conclusion',
        'conclusionde',
        'consultation_id',
        'patient_id'
    ];

    public function Consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    // public function Patient()
    // {
    //     return $this->belongsTo(Patient::class);
    // }
}
