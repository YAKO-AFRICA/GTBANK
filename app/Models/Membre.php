<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Equipe;
use App\Models\Reseau;
use App\Models\Partner;
use App\Models\MembreContrat;
use App\Models\AgenceByParter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membre extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'membre';

    protected $primaryKey = 'idmembre';

    public $incrementing = true;

    protected $fillable = [
        'idmembre',
        'id_session',
        'nom',
        'prenom',
        'cel',
        'tel',
        'pays',
        'ville',
        'email',
        'login',
        'pass',
        'date',
        'datemodif',
        'token',
        'enligne',
        'lastvisite',
        'nbrevisite',
        'memberok',
        'droits',
        'navigation_securise',
        'photo',
        'codeagent',
        'typ_membre',
        'activer',
        'branche',
        'partenaire',
        'codepartenaire',
        'agence',
        'datenaissance',
        'lieuresidence',
        'lieunaissance',
        'profession',
        'codereseau',
        'codezone',
        'codeequipe',
        'role',
        'coderole',
        'sexe',
        'cel2',
        'nomagence',
        'passmodifier',
        'passmodifierle',
        'estajour',
        'datevalidite',
        'paiementok',
        'lastpaiement',
        'devis',
        'isemploye',
        'isbranmaster',
        'ispartmaster',
        'isadmin',
        'user_parent',
    ];

    public $timestamps = false;

    public function reseau()
    {
        return $this->belongsTo(Reseau::class, 'codereseau');
    }
    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'codeequipe');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'codezone', 'id');
    }
    public function membreContrat()
    {
        return $this->hasMany(MembreContrat::class, 'codemembre', 'idmembre');
    }

    public function agences()
    {
        return $this->belongsTo(AgenceByParter::class, 'agence', 'id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'codepartenaire', 'code');
    }
}
