<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographieMammaire extends Model
{
    use HasFactory;
    protected $table = 'echographie_mammaires';

    protected $fillable = [
        'date',
        'motif_examen',
        'DDR',
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
