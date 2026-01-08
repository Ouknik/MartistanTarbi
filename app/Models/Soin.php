<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soin extends Model
{
    use HasFactory;
    protected $table = 'soins';
    protected $fillable = [
        'libelleSoin',
        'montantSoin',
        'pathSoin'
    ];
    public $timestamps = false;

    protected $appends = [
        'countConsultation'
    ];

    public function Consultations()
    {
        return $this->belongsToMany(Consultation::class, 'soins_consultations');
    }

    protected function getcountConsultationAttribute()
    {
        return $this->Consultations()->count();
    }
}
