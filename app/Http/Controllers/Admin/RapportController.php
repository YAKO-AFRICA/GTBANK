<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pret;
use App\Models\Membre;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    public function eSouscription(Request $request)
    {
        $userPartner = Auth::user()->codepartenaire;

        $agents = Membre::where('codepartenaire', $userPartner)->get();

        $query = Contrat::where('partenaire', $userPartner);

        // Filtrer par date (de et à)
        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('saisiele', [$request->dateFrom, $request->dateTo]);
        }

        // Filtrer par agent
        if ($request->filled('agent')) {
            $query->where('saisiepar', $request->agent);
        }

        // Filtrer par étape
        if ($request->filled('etape')) {
            $query->where('etape', $request->etape);
        }

        // Exécuter la requête
        $contrats = $query->get();


        $defaultColumns = ['#', 'Produit', 'Date Effet', 'Prime', 'Capital', 'Saisir Par', 'Status'];

        $additionalColumns = [
            'Mode de Paiement' => 'modepaiement',
            'Organisme' => 'organisme',
            'Prime' => 'prime',
            'Prime Principale' => 'primepricipale',
            'Capital' => 'capital',
            'Surprime' => 'surprime',
            'Date Effet' => 'dateeffet',
            'N° Compte' => 'numerocompte',
            'Agence' => 'agence',
            'Saisie Le' => 'saisiele',
            'Code Conseiller' => 'codeConseiller',
            'Nom Agent' => 'nomagent',
            'Duree' => 'duree',
            'Periodicite' => 'periodicite',
            'Code Adherent' => 'codeadherent',
            'Est Migre' => 'estMigre',
            'Transmis Le' => 'transmisle',
            'Annuler Le' => 'annulerle',
            'Accepter Le' => 'accepterle',
            'Modifier Le' => 'modifierle',
            'Modifier Par' => 'modifierpar',
            'Libelle Produit' => 'libelleproduit',
            'Personne Ressourource' => 'personneressource',
            'Contact Ressourource' => 'contactpersonneressource',
            'Beneficiaire Auterme' => 'beneficiaireauterme',
            'Beneficiaire Audeces' => 'beneficiaireaudeces',
            'Accepter Par' => 'accepterpar',
            'Rejeter Par' => 'rejeterpar',
            'Transmis Par' => 'transmispar',
            'Personne Ressource 2' => 'personneressource2',
            'Contact Ressource 2' => 'contactpersonneressource2',
            'Code Banque' => 'codebanque',
            'Code Guichet' => 'codeguichet',
            'Rib' => 'rib',
            'Id Proposition' => 'idproposition',
            'Code Proposition' => 'codeproposition',
            'Branche' => 'branche',
            'Partenaire' => 'partenaire',
            'Nom Accepter Par' => 'nomaccepterpar',
            'Ref Contrat Source' => 'refcontratsource',
            'Cle Integration' => 'cleintegration',
            'Code Operation' => 'codeoperation',
            'N° Police' => 'numeropolice',
            'Frais Adhesion' => 'fraisadhesion',
            'Est Paye' => 'estpaye',
            'Pret Connexe' => 'pretconnexe',
            'Details' => 'details',
        ];
        $activeColumns = session('activeColumns', []);

        $selectedStatus = $request->input('etape');

        // Retourner la vue avec les données
        return view('rapport.eSouscription', compact('contrats', 'agents', 'activeColumns', 'defaultColumns', 'additionalColumns'));
    }
    public function ePret(Request $request)
    {
        $userPartner = Auth::user()->codepartenaire;

        $agents = Membre::where('codepartenaire', $userPartner)->get();

        $query = Pret::where('partenaire', $userPartner);

        // Filtrer par date (de et à)
        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('saisiele', [$request->dateFrom, $request->dateTo]);
        }

        // Filtrer par agent
        if ($request->filled('agent')) {
            $query->where('saisiepar', $request->agent);
        }

        // Filtrer par étape
        if ($request->filled('etape')) {
            $query->where('etat', $request->etape);
        }

        // Exécuter la requête
        $prets = $query->get();



        $defaultColumns = ['#', 'Type', 'Date Effet', 'Prime Total', 'Montant', 'Saisir Par', 'Status'];

        $additionalColumns = [
            'Mode de Paiement' => 'modepaiement',
            'Organisme' => 'organisme',
            'Prime' => 'prime',
            'Prime Principale' => 'primepricipale',
            'Capital' => 'capital',
            'Surprime' => 'surprime',
            'Date Effet' => 'dateeffet',
            'N° Compte' => 'numerocompte',
            'Agence' => 'agence',
            'Saisie Le' => 'saisiele',
            'Code Conseiller' => 'codeConseiller',
            'Nom Agent' => 'nomagent',
            'Duree' => 'duree',
            'Periodicite' => 'periodicite',
            'Code Adherent' => 'codeadherent',
            'Est Migre' => 'estMigre',
            'Transmis Le' => 'transmisle',
            'Annuler Le' => 'annulerle',
            'Accepter Le' => 'accepterle',
            'Modifier Le' => 'modifierle',
            'Modifier Par' => 'modifierpar',
            'Libelle Produit' => 'libelleproduit',
            'Personne Ressourource' => 'personneressource',
            'Contact Ressourource' => 'contactpersonneressource',
            'Accepter Par' => 'accepterpar',
            'Rejeter Par' => 'rejeterpar',
            'Transmis Par' => 'transmispar',
            'Personne Ressource 2' => 'personneressource2',
            'Contact Ressource 2' => 'contactpersonneressource2',
            'Code Banque' => 'codebanque',
            'Code Guichet' => 'codeguichet',
            'Rib' => 'rib',
            'Id Proposition' => 'idproposition',
            'Code Proposition' => 'codeproposition',
            'N° Police' => 'numeropolice',
            'Frais Adhesion' => 'fraisadhesion',
            'Details' => 'details',
        ];
        $activeColumns = session('activeColumns', []);

        // Retourner la vue avec les données
        return view('rapport.ePret', compact('prets', 'agents', 'activeColumns', 'defaultColumns', 'additionalColumns'));
    }

}
