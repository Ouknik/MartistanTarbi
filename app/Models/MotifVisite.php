<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotifVisite extends Model
{
    use HasFactory;

    protected $table='motif_visites';
    protected $fillable = ['motifVisite'];
    public $timestamps = false;
}
