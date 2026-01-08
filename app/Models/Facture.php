<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';
    protected $fillable = [
        'dateFacture',
        'tvaFacture',
        'montantFacture',
        'patient_id ',
        'paiement_id ',
        'montantLettre'
    ];

    protected $appends = ['ConsultationDocteurID'];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function Paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
    public function Consultation()
    {
        return $this->belongsToMany(Consultation::class, 'factures_consultations');
    }

    protected function getConsultationDocteurIDAttribute()
    {
        $consultationDocteur = $this->Consultation()->get();
        return $consultationDocteur[0]['user_id'];
    }
}
