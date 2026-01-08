<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FamilleAnalyse extends Model
{
    use HasFactory;

    protected  $table = 'famille_analyses';
    protected $fillable = [
        'familleanalyse'
    ];
    protected $appends = ['Analyses','CountAnalyses'];



    public function Analyses()
    {
        return $this->hasMany(Analyse::class);
    }

    protected function getAnalysesAttribute()
    {
        return $this->Analyses()->get();
    }

    protected function getCountAnalysesAttribute()
    {
        return $this->Analyses()->count();
    }

    protected static function booted()
    {
        static::deleting(function($familleAnalyse){
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $Analyses =$familleAnalyse->Analyses();
            $Analyses->SousAnalyses()->delete();
            $familleAnalyse()->Analyses()->delete();
        });
    }
}
