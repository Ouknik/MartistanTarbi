<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisDossierNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'dossier_number',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
