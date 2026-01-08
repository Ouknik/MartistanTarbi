<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echographie extends Model
{
    use HasFactory;
    protected $table = 'echographies';
    protected $fillable = [
        'typeEcho',
        'contenuEcho',
        'consultation_id',
        'patient_id',
        'dateEcho'
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
