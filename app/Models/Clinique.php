<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinique extends Model
{
    use HasFactory;


    protected $table = 'cliniques';
    protected $fillable = [
        'nomClinique',
        'villeClinique',
    ];

    protected $appends = ['TotalClinique','TotalReglement','TotalOperations','ReglementsOperation','countOperations'];

    public function Operations()
    {
        return $this->hasMany(OperationPatient::class);
    }

    public function Reglements()
    {
        return $this->hasMany(ReglementOperation::class);
    }

    protected function getReglementsOperationAttribute()
    {
        return $this->Reglements()->get();
    }

    protected function getTotalCliniqueAttribute()
    {
        return $this->Operations()->sum('MontantValideeOperation');
    }

    protected function getTotalReglementAttribute()
    {
        return $this->Reglements()->sum('montantReglement');
    }

    protected function getTotalOperationsAttribute()
    {
        return $this->Operations()->count();
    }

    protected function getcountOperationsAttribute()
    {
        return $this->Operations()->count();
    }


}
