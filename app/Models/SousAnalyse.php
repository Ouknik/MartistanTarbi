<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousAnalyse extends Model
{
    use HasFactory;
    protected $table = 'sous_analyses';
    protected $fillable = [
        'nomSousAnalyse',
        'analyse_id'

    ];

    public function Analyse()
    {
        return $this->belongsTo(Analyse::class);
    }

    public function Consultations()
    {
        return $this->belongsToMany(Consultation::class, 'sous_analyses_consultations', 'consultation_id', 'sous_analyse_id');
    }
}
