<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    use HasFactory;

    protected $table='assurances';
    protected $fillable = ['typeAssurance','imageAssurance'];
    public $timestamps = false;
    protected $appends = [
        'countPatients'
    ];

    public function Patients()
    {
        return $this->belongsToMany(Patient::class);
    }

    protected function getcountPatientsAttribute()
    {
        return Patient::where('assurance_id',$this->id)->count();
    }


}
