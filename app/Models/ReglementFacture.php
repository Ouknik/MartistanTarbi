<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglementFacture extends Model
{
    use HasFactory;
    protected $table = 'reglement_factures';
    protected $fillable = [
        'montantReglement',
        'modePaiement',
        'dateReglement',
        'motifVisite',
        'patient_id',
        'typeAssurance',
        'user_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function docteur()
    {
        return $this->belongsTo(Docteur::class,'user_id');
    }
}
