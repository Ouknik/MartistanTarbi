<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographieNormale extends Model
{
    use HasFactory;
    protected $table = 'echographie_normales';

    protected $fillable = [
        'date',
        'compte_rendu',
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
