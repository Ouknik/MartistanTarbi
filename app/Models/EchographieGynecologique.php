<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EchographieGynecologique extends Model
{
    use HasFactory;

    protected $table = 'echographie_gynecologiques';

    protected $fillable = [
        'date',
        'uterus',
        'caviteUterine',
        'endometre',
        'annexeGauche',
        'annexeDroite',
        'culDeSacDouglas',
        'conclusion',
        'consultation_id'
    ];

    public function Consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
