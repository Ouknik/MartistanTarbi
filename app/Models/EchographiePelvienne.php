<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographiePelvienne extends Model
{
    use HasFactory;
    protected $table = 'echographie_pelviennes';

    protected $fillable = [
        'indication',
        'vessie',
        'vaginetcol',
        'uterus_position',
        'uterus_contours',
        'uterus_echo_structure',
        'endometre',
        'uterine_cavite',
        'ovaire_droit',
        'ovaire_gauche',
        'trompe_droit',
        'trompe_gauche',
        'douglass',
        'conclusion',
        'date',
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
