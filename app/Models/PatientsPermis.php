<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientsPermis extends Model
{
    use HasFactory;

    protected $table = 'patients_permis';
    protected $fillable = [
        'numeroDossier',
        'nom',
        'prenom',
        'dateNaissance',
        'genre',
        'dateVisite',
        'montantAPayer',
        'montantPayer',
        'patient_id'
    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
