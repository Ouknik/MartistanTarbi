<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Analyse extends Model
{
    use HasFactory;

    protected $table = 'analyses';
    protected $fillable = ['nomAnalyse', 'famille_analyse_id'];
    protected $appends = ['Familleanalyse'];


    public function SousAnalyses()
    {
        return $this->hasMany(SousAnalyse::class);
    }

    public function FamilleAnalyse()
    {
        return $this->belongsTo(FamilleAnalyse::class, 'famille_analyse_id');
    }

    protected function getFamilleanalyseAttribute()
    {
        $familleAnalyse = FamilleAnalyse::find($this->famille_analyse_id);

        if ($familleAnalyse) {
            return $familleAnalyse->familleanalyse;
        }
    }
    public function Consultations()
    {
        return $this->belongsToMany(Consultation::class, 'examens_consultations');
    }

    protected static function booted()
    {
        static::deleting(function ($analyse) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $analyse->SousAnalyses()->delete();
        });
    }
}
