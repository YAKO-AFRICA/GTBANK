<?php

namespace App\Models;

use PhpParser\Node\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adherent extends Model
{
    use HasFactory;

    protected $table = 'tbladherent';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'civilite',
        'nom',
        'prenom',
        'datenaissance',
        'lieunaissance',
        'estmigre',
        'sexe',
        'numeropiece',
        'naturepiece',
        'lieuresidence',
        'profession',
        'employeur',
        'email',
        'mobile',
        'mobile1',
        'telephone',
        'pays',
        'bp',
        'telephone1',
        'codemembre',
        'saisieLe',
        'saisiepar',
        'refcontratsource',
        'cleintegration',
        'id_maj',
        'connexe',
        'contratconnexe',
        'capitalconnexe',
    ];

    protected function datenaissance(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? date('Y-m-d', strtotime($value)) : null,
        );
    }
}
