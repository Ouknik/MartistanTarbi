<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographieDeuxiemeTrimestreGem extends Model
{
    use HasFactory;

    protected $table = 'echographie_deuxieme_trimestre_gems';

    protected $fillable = [
        'date',
        'indication',
        'grossesse_gemellaire',
        'activite_cardiaque',
        'mouvements_actifs',
        'mouvements_respiratoires',
        'presentation1',
        'presentation2',
        'liquide_amniotique',
        'localisation_placenta',
        'grade_placenta',
        'cordon',
        'diametre_biparietal_1',
        'diametre_biparietal_1_sa',
        'diametre_biparietal_1_j',
        'longueur_femur_1',
        'longueur_femur_1_sa',
        'longueur_femur_1_j',
        'diametre_biparietal_2',
        'diametre_biparietal_2_j',
        'diametre_biparietal_2_sa',
        'longueur_femur_2',
        'longueur_femur_2_sa',
        'longueur_femur_2_j',
        'diam_abd_trans',
        'diam_abd_trans_sa',
        'diam_abd_trans_j',
        'circonf_abd',
        'circonf_abd_sa',
        'circonf_abd_j',
        'crane',
        'rachis',
        'coeur',
        'estomac',
        'vessie',
        'reins',
        'membres',
        'paroi_abdominale',
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
