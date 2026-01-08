<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedent extends Model
{
    use HasFactory;
    protected $table = 'antecedents';
    protected $fillable = ['typeAntecedent', 'nomAntecedent'];
    public $timestamps = false;

    public function Patients()
    {
        return $this->belongsToMany(Patient::class, 'patients_antecedents')->withPivot('valeurAntecedent', 'descriptientAntecedent');
    }
}
