<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationPatient extends Model
{
    use HasFactory;
    protected $table = 'operation_patients';
    protected $fillable = [
        'dateOperation',
        'prixOperation',
        'MontantValideeOperation',
        'MontantRestantOperation',
        'nomOperation',
        'descriptionOperation',
        'etatOperation',
        'clinique_id',
        'patient_id',
    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function Clinique()
    {
        return $this->belongsTo(Clinique::class);
    }
}
