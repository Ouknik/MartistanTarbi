<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $table = 'ordonnances';
    protected $fillable = [
        'dateOrdonnance',
        'consultation_id ',
        'patient_id ',
        'user_id ',
    ];

    protected $appends = ['ConsultationDocteurID'];

    public function Consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function Medicaments()
    {
        return $this->belongsToMany(Medicament::class, 'ordonnances_medicaments')->withPivot('prescription','typeOrdonnance');
    }

    public function Docteur()
    {
        return $this->belongsTo(User::class);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }

    protected function getConsultationDocteurIDAttribute()
    {
        $consultationDocteur = $this->Consultation()->get();
        return $consultationDocteur[0]['user_id'];
        //return $this->Consultation->pluck('user_id')->first()
    }
}
