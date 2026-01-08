<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestationnelle extends Model
{
    use HasFactory;

    protected $table = 'gestationnelles';
    protected $fillable = [
        'dateDernierRegle',
        'dateGrosesse',
        'dateAccouchement',
        'patient_id',
    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
