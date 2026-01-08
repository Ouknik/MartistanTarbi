<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $fillable = ['nomExamen'];
    public function Consultations()
    {
        return $this->belongsToMany(Consultation::class, 'examens_consultations');
    }

    public function Soin()
    {
        return $this->hasOne(Soin::class);
    }
}
