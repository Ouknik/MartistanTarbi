<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    protected $table = 'medicaments';
    protected $fillable = [
        'codeMedicament',
        'nomMedicament',
        'dosageMedicament',
        'uniteDosageMedicament',
        'formeMedicament',
        'presentationMedicament',
        'prixMedicament',
        'uniteMessure',
    ];
    protected $appends = [
        'countMedicamentOrdonnance', 'countMedicamentTraitement'
    ];

    public function Ordonnance()
    {
        return $this->belongsToMany(Ordonnance::class, 'ordonnances_medicaments')->withPivot('typeOrdonnance','prescription');
    }

    public function Stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function Traitements()
    {
        return $this->belongsToMany(Traitement::class, 'medicaments_traitements')->withPivot('typeOrdonnance','prescription');
    }
    protected function getcountMedicamentOrdonnanceAttribute()
    {
        return $this->Ordonnance()->count();
    }

    protected function getcountMedicamentTraitementAttribute()
    {
        return $this->Traitements()->count();
    }

    public function Prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
