<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantie extends Model
{
    use HasFactory;

    protected $table = 'tblgaranties';

    protected $fillable = [
        'codeproduit',
        'codeproduitgarantie',
        'libelle',
        'estobligatoire',
        'naturegarantie',
        'type',
        'taux',
        'montantgarantie',
        'agemin',
        'agemax',
        'dureecotisationmin',
        'dureecotisationmax',
        'dureecontratmin',
        'dureecontratmax',
        'primemin',
        'branche',
        'description',
        'estunique',
        'estprincipal',
        'estcomplementaire',
    ];
}
