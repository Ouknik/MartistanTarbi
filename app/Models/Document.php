<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table ='documents';
    protected $fillable=[
        'nomDocument',
        'pathDocument',
        'patient_id'
    ];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
