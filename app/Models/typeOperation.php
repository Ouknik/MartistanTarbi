<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeOperation extends Model
{
    use HasFactory;
    protected $table='type_operations';
    protected $fillable = ['typeOperation'];
    public $timestamps = false;
}
