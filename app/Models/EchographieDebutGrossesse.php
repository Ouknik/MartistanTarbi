<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographieDebutGrossesse extends Model
{
    use HasFactory;

    protected $table = 'echographie_debut_grossesses';

    protected $fillable = [
        'date',
        'indication',
        'uterus',
        'oeuf',
        'embryon',
        'sacGestationnel',
        'aControler',
        'conclusion',
        'consultation_id',
        'patient_id'
    ];

    public function Consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }


}
