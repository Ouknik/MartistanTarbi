<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;
    protected $table='rendez_vouses';
    protected $fillable=[
        'dateRendezVous',
        'typeRendezVous',
        'etatRendezVous',
        'patient_id',
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
