<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $table = 'prescriptions';
    protected $fillable = [
        'prescription',
        'medicament_id',
    ];

    public function Medicaments()
    {
        return $this->belongsTo(Medicament::class);
    }
}
