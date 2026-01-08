<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographieDeuxiemeTrimestre extends Model
{
    use HasFactory;

    protected $table = 'echographie_deuxieme_trimestres';

    protected $fillable = [
        'date',
        'indication',
        'grossesse_unique',
        'activite_cardiaque',
        'mouvements_actifs',
        'mouvements_respiratoires',
        'presentation',
        'liquide_amniotique',
        'placenta_localisation',
        'placenta_grade',
        'placenta_cordon',
        'diametre_biparietal',
        'diametre_biparietal_sa',
        'diametre_biparietal_j',
        'longueur_femur',
        'longueur_femur_sa',
        'longueur_femur_j',
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
