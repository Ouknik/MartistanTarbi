<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;
    protected $table = 'traitements';
    protected $fillable=[
        'nomTraitement',
        'dureeTraitement',
        'NombreComprime',
        'typeOrdonnance'
    ];
    public function Medicaments()
    {
        return $this->belongsToMany(Medicament::class,'medicaments_traitements')->withPivot('prescription');
    }
}
