<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Parental\HasParent;

class Secretaire extends User
{
    use HasParent;
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->morphOne(User::class, 'role');
    }
    protected $table = 'secretaires';
    protected $fillable = [

        'cinSecretaire',
        'nomSecretaire',
        'prenomSecretaire',
        'dateNaissanceSecretaire',
        'telephoneSecretaire',
        'adresseSecretaire',
        'sexeSecretaire',
        'villeSecretaire',
        'emailSecretaire',
        'nationaliteSecretaire',
        'descriptionSecretaire',
    ];
}
