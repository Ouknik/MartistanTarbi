<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acte extends Model
{
    use HasFactory;

    public function Consultation()
    {
        return $this->belongsToMany(Consultation::class);
    }
}
