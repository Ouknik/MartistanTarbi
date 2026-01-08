<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglementOperation extends Model
{
    use HasFactory;

    protected $table = 'reglement_operations';
    protected $fillable = [
        'montantReglement',
        'modeReglement',
        'dateReglement',
        'clinique_id',
        'user_id',
    ];

    // protected $appends = ['TotalReglements'];


    public function Clinique()
    {
        return $this->belongsTo(Clinique::class);
    }

   
}
