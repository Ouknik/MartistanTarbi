<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    use HasFactory;
    protected $table = 'certificats';
    protected $fillable = [
        'dateCertificat',
        'typeCertificat',
        'duree',
        'contenu',
        'user_id',
        'patient_id',

    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
