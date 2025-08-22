<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitGarantie extends Model
{
    use HasFactory;

    protected $table = 'tblproduitgarantie';

    public $timestamps = false;

    protected $fillable = [
        'IdProduitGarantie',
        'CodeProduitGarantie',
        'MonLibelle',
        'CodeGarantieNature',
        'CodeFormeGarantie',
        'CodeGarantieModeTarif',
        'CodeProduit',
        'Coderisque',
        'CodeCategorieAssure',
        'CodeProfilAssure',
        'CodeMethodeInterp',
        'CodeAnnualisation',
        'CodeExposition',
        'CodePaiement',
        'TauxInteret',
        'PctInteretCouvFrais',
        'CodeModeSoumission',
        'CodeClassification',
        'AgeminiAss',
        'AgeMaxiAss',
        'DureeMiniCouv',
        'DureeMaxiCouv',
        'CapitalMini',
        'CapitalMaxi',
        'AgeLimiteCouv',
        'ExpFinAnneeCivile',
        'Renouvellement',
        'DureeAns',
        'DureeMois',
        'CodeAgeCalcul',
        'PMCalculOK',
        'CapitalAssureOK',
        'PrimePctCapital',
        'Commissionne',
        'ID_Old',
        'PrioriteEncaissement',
        'Exceptionnel',
    ];
}
