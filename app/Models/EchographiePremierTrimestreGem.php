<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographiePremierTrimestreGem extends Model
{
    use HasFactory;
    protected $table = 'echographie_premier_trimestre_gems';

    protected $fillable = [
        'date',
        'indication',
        'uterus',
        'oeuf_nombre',
        'oeuf_aspect',
        'vesicule_ombilicale_mm',
        'embryon_nombre',
        'activite_cardiaque',
        'mouvements_actifs',
        'clarte_nucale_mm',
        'long_cranio_caudale_1_mm',
        'long_cranio_caudale_1_sa',
        'long_cranio_caudale_1_j',
        'long_cranio_caudale_2_mm',
        'long_cranio_caudale_2_sa',
        'long_cranio_caudale_2_j',
        'diametre_biparietal_1_mm',
        'diametre_biparietal_1_sa',
        'diametre_biparietal_1_j',
        'diametre_biparietal_2_mm',
        'diametre_biparietal_2_sa',
        'diametre_biparietal_2_j',
        'annexe_gauche',
        'annexe_droite',
        'conclusion',
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
