<?php

namespace App\Http\Controllers\Admin;
use PDF;

use Carbon\Carbon;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Assurer;
use App\Models\Contrat;
use App\Models\Product;
use setasign\Fpdi\Fpdi;
use App\Models\Adherent;
use App\Models\Document;
use App\Models\Garantie;
use App\Models\TblVille;
use App\Models\TblAgence;
use App\Models\Profession;
use App\Models\TblSociete;
use Illuminate\Support\Str;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use App\Models\ReseauProduct;
use App\Models\TblProfession;
use App\Models\AgenceByParter;
use App\Models\AssureGarantie;
use App\Models\ProduitGarantie;
use App\Models\TblSecteurActivite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductionController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        set_time_limit(300);
        $mesPropositions = Contrat::where('saisiepar', Auth::user()->idmembre)->get();
        $allPropositionssss = Contrat::where('etape', "!=", "");
        $allPropositions = Contrat::where('saisiepar', Auth::user()->idmembre);
        // $allPropoEnSaisie = Contrat::where('etape', 0)->get();
        // $allPropoTransmis = Contrat::where('etape', 2)->get();
        // $allPropoAccepter = Contrat::where(['etape' => 3])->get();
        // $allPropoRejet = Contrat::where('etape', 4)->get();
        // \dd($allPropoAccepter);

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

        if ($selectedStatus) {
            // Filtrez par statut si un statut est sélectionné
            $allPropositions->where('etape', $selectedStatus);
        }

        $allPropositionsFiltered = $allPropositions->get();

        
        $datas = collect([
            'allPropositionsFiltered' => $allPropositionsFiltered,
            'mesPropositions' => $mesPropositions,
            'allPropositions' => $allPropositions,
            // 'allPropoEnSaisie' => $allPropoEnSaisie,
            // 'allPropoTransmis' => $allPropoTransmis,
            // 'allPropoAccepter' => $allPropoAccepter,
            // 'allPropoRejet' => $allPropoRejet,
        ]);

        // return view('productions.index', compact('datas'));
        return view('productions.index', ['datas' => $datas, 'activeColumns' => $activeColumns, 'defaultColumns' => $defaultColumns, 'additionalColumns' => $additionalColumns]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function stepProduct()
    {

        $productByReseau = ReseauProduct::select('CodeProduit')
            ->where('codereseau', Auth::user()->membre->codereseau)
            ->get();

        $codeProduits = $productByReseau->pluck('CodeProduit')->toArray();

        $products = Product::whereIn('CodeProduit', $codeProduits)->get();

        // dd($products);
        return view('productions.create.steps.stepProduct', compact('products'));
    }

    public function addAssureToSession(Request $request)
    {
        // Récupérer les assurés actuels dans la session ou initialiser un tableau vide
        $assures = session()->get('assures', []);
        
        // Ajouter les informations du nouvel assuré
        $assures[] = $request->only(['civiliteAssur', 'nomAssur', 'prenomAssur', 'datenaissanceAssur', 'lieunaissanceAssur', 'naturepieceAssur', 'numeropieceAssur', 'lieuresidenceAssur', 'lienParente', 'mobileAssur', 'emailAssur']);
        
        // Stocker les informations mises à jour dans la session
        session()->put('assures', $assures);

        return response()->json(['message' => 'Assuré ajouté avec succès', 'assures' => $assures]);
    }

    public function getAssuresFromSession()
    {
        $assures = session()->get('assures', []);
        return response()->json($assures);
    }

    public function create($codeProduit)
    {

        $product = Product::where('CodeProduit', $codeProduit)->first();

        $productGarantie = ProduitGarantie::where('CodeProduit',$codeProduit)->get();
        $villes =  TblVille::select('libelleVillle')->get();
        $professions =  Profession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  AgenceByParter::where('codePartner', Auth::user()->membre->codepartenaire)->get();


        return view ('productions.create.create', compact('product', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences'));
    }

  
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            Log::info("demarrage souicription: " );



                $racine = "8301100011116";

                // $numeroBulletin = RefgenerateBulletin(Contrat::class,'SECURICPTE', 'numBullettin', '8301100011116');

                // Log::info("numGenerer: " . $numeroBulletin);

                $product = Product::where('CodeProduit', $request->codeproduit)->first();

                $prime = $request->primepricipale + $request->surprime + $request->fraisadhesion;
                $primeGarantie = $request->primepricipale + $request->surprime;
        

                // Gestion de la civilité pour l'adhérent et l'assuré
                $sexe = $request->civilite === "Monsieur" ? "M" : "F";
                $sexeassur = $request->civiliteAssur === "Monsieur" ? "M" : "F";

                $datenaissance = Carbon::parse($request->datenaissance)->format('Y-m-d H:i:s');

                // creation id 
                $idAdherent = Adherent::max('id') + 1;
                $idAssure = Assurer::max('id') + 1;
                $idBenef = Beneficiaire::max('id') + 1;
                $idContrat = Contrat::max('id') + 1;
                $idDocument = Document::max('id') + 1;


                $Adherent = Adherent::create([
                    'id' => $idAdherent,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $datenaissance,
                    'lieunaissance' => $request->lieunaissance,
                    'sexe' => $sexe,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidence,
                    'profession' => $request->profession,
                    'employeur' => $request->employeur,
                    'pays' => $request->pays,
                    'estmigre' => 0,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'telephone1' => $request->telephone1,
                    'mobile' => $request->mobile,
                    'codemembre' => 0,
                    'mobile1' => $request->mobile1,
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                    'refcontratsource' => $request->refcontratsource,
                    'cleintegration' => $request->cleintegration,
                    'id_maj' => $request->id_maj,
                    'connexe' => $request->connexe,
                    'contratconnexe' => $request->contratconnexe,
                    'capitalconnexe' => $request->capitalconnexe,
                    
                ])->save();

                Log::info("Adherent: " . $Adherent);

                // Récupérer les assurés du formulaire
                $assures = json_decode($request->input('assures'), true);

                $garanties = Garantie::where('codeproduit', $request->codeproduit)->get();


                if ($request->estAssure === "Oui") {
                    Assurer::create([
                        'id' => $idAssure,
                        'civilite' => $request->civilite,
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'datenaissance' => $datenaissance,
                        'lieunaissance' => $request->lieunaissance,
                        'codecontrat' => $idContrat,
                        'codeadherent' => $idAdherent,
                        'sexe' => $sexe,
                        'numeropiece' => $request->numeropiece,
                        'naturepiece' => $request->naturepiece,
                        'lieuresidence' => $request->lieuresidence,
                        'profession' => $request->profession,
                        'employeur' => $request->employeur,
                        'pays' => $request->pays,
                        'email' => $request->email,
                        'telephone' => $request->telephone,
                        'telephone1' => $request->telephone1,
                        'mobile' => $request->mobile,
                        'codemembre' => 0,
                        'mobile1' => $request->mobile1,
                        'saisieLe' => now(),
                        'saisiepar' => auth::user()->membre->idmembre,
                    ])->save();

                    foreach ($garanties as $garantie) {
                        AssureGarantie::create([
                            'codeproduitgarantie' => $garantie->codeproduitgarantie,
                            'idproduitparantie' => $garantie->id,
                            'monlibelle' => $garantie->libelle,
                            // 'prime' => $primeGarantie,
                            'prime' => $request->primepricipale,
                            'primetotal' => $request->primepricipale,
                            'primeaccesoire' => 0,
                            'type' => "Mixte",
                            'capitalgarantie' => $request->capital,
                            'tauxinteret' => $request->tauxinteret,
                            'codeassure' => $idAssure,
                            'codecontrat' => $idContrat,
                            'estmigre' => 0,
                        ])->save();
                    }


                }

                if ($assures) {
                    foreach ($assures as $assure) {
                        $datenaissanceAssur = isset($assure['datenaissance']) ? Carbon::parse($assure['datenaissance'])->format('Y-m-d H:i:s') : null;
                        $idAssureInsert = Assurer::max('id') + 1;
                        Assurer::create([
                            'id' => $idAssureInsert,
                            'civilite' => $assure['civilite'],
                            'nom' => $assure['nom'],
                            'prenom' => $assure['prenom'],
                            'datenaissance' => $datenaissanceAssur,
                            'codecontrat' => $idContrat,
                            'codeadherent' => $idAdherent,
                            'lieunaissance' => $assure['lieuNaissance'],
                            'numeropiece' => $assure['numeropiece'] ?? null,
                            'naturepiece' => $assure['naturepiece'] ?? null,
                            'lieuresidence' => $assure['lieuresidence'] ?? null,
                            'filiation' => $assure['lienParente'],
                            'mobile' => $assure['mobile'] ?? null,
                            'estmigre' => $request->estmigre ?? null,
                            'email' => $assure['email'] ?? null,
                            'sexe' => $sexeassur,
                            'saisieLe' => now(),
                            'saisiepar' => Auth::user()->membre->idmembre,
                        ]);
                    }
                }


                // Récupérer et enregistrer les bénéficiaires
                $beneficiaires = json_decode($request->input('beneficiaires'), true);

                if ($request->addBeneficiary === "adherent") {
                    $benefauterm = "adherent";
                    $datenaissanceBenef = Carbon::parse($request->datenaissanceBenef)->format('Y-m-d H:i:s');
                    
                    Beneficiaire::create([
                        'id' => $idBenef,
                        'civilite' => $request->civilite,
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'datenaissance' => $datenaissanceBenef,
                        'codecontrat' => $idContrat,
                        'codeadherent' => $idAdherent,
                        'lieunaissance' => $request->lieunaissance,
                        'numeropiece' => $request->numeropiece,
                        'naturepiece' => $request->naturepiece,
                        'lieuresidence' => $request->lieuresidence,
                        'filiation' => $request->lienParente,
                        'mobile' => $request->mobile,
                        'email' => $request->email,
                        'saisieLe' => now(),
                        'saisiepar' => Auth::user()->membre->idmembre,
                    ])->save();
                }else{
                    $benefauterm = "autre";
                }

                if ($beneficiaires) {

                    foreach ($beneficiaires as $beneficiaire) {
                        $datenaissanceBeneficiaire = isset($beneficiaire['dateNaissance']) ? Carbon::parse($beneficiaire['dateNaissance'])->format('Y-m-d H:i:s') : null;
                        $idBenefInsert = Beneficiaire::max('id') + 1;
                        Beneficiaire::create([
                            'id' => $idBenefInsert,
                            'civilite' => $beneficiaire['civilite'] ?? null,
                            'nom' => $beneficiaire['nom'],
                            'prenom' => $beneficiaire['prenom'],
                            'datenaissance' => $datenaissanceBeneficiaire,
                            'codecontrat' => $idContrat,
                            'codeadherent' => $idAdherent,
                            'lieunaissance' => $beneficiaire['lieuNaissance'],
                            'numeropiece' => $beneficiaire['numeropiece'] ?? null,
                            'naturepiece' => $beneficiaire['naturepiece'] ?? null,
                            'lieuresidence' => $beneficiaire['lieuResidence'],
                            'filiation' => $beneficiaire['lienParente'],
                            'mobile' => $beneficiaire['telephone'],
                            'email' => $beneficiaire['email'],
                            'saisieLe' => now(),
                            'saisiepar' => Auth::user()->membre->idmembre,
                        ]);
                    }
                }

                // ajout du contrat   numMobile  duree

                if ($request->modepaiement === "Mobile_money") {
                    $numerocompte = $request->numMobile;
                }else{
                    $numerocompte = $request->numerocompte;
                }
                

               Log::info("demarrage save contrat");

                $contratData = Contrat::create([
                    'id' => $idContrat,
                    'dateeffet' => $request->dateEffet,
                    'modepaiement' => $request->modepaiement,
                    'organisme' => $request->organisme,
                    'agence' => $request->agence,
                    'numerocompte' => $numerocompte,
                    'periodicite' => $request->periodicite,
                    Log::info("demarrage save periodicite"),
                    
                    'codeConseiller' => Auth::user()->membre->codeagent,
                    'nomagent' => Auth::user()->membre->nom.' '.Auth::user()->membre->prenom,

                    // 'prime' => $request->prime,

                    'primepricipale' => number_format($request->primepricipale, 2, ".", ""),
                    'prime' => $prime,
                    'fraisadhesion' => $request->fraisadhesion,

                    'surprime' => $request->surprime,
                    // 'capital' => $request->capital,
                    'capital' => number_format($request->capital, 2, ".", ""),
                    'etape' => 1,
                    Log::info("demarrage save etape"),
                    
                    'saisiele' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                    
                    'duree' => $request->duree,
                    
                    'codeadherent' => $idAdherent,
                    'estMigre' => 0,
                    'codeproduit' => $request->codeproduit,
                    // 'numBullettin' => $numBullettin,

                    // 'transmisle' => now(),
                    // 'annulerle' => null,
                    // 'accepterle' => null,
                    // 'modifierle' => null,
                    // 'modifierpar' => null,
                    // 'motifrejet' => null,
                    // 'libelleproduit' => $product->MonLibelle,
                    'libelleproduit' => 'SECURICOMPTE GTBANK',
                    // 'montantrente' => $request->montantrente,
                    // 'periodiciterente' => $request->periodiciterente,
                    // 'dureerente' => $request->dureerente,

                    Log::info("demarrage save libelleproduit"),

                    'personneressource' => $request->personneressource,
                    'contactpersonneressource' => $request->contactpersonneressource,
                    'beneficiaireauterme' => $benefauterm,
                    'beneficiaireaudeces' => $request->audecesContrat,
                    // 'accepterpar' => $idContrat,
                    // 'rejeterpar' => $idAdherent,
                    // 'transmispar' => $request->saisiepar,
                    'personneressource2' => $request->personneressource2,
                    'contactpersonneressource2' => $request->contactpersonneressource2,
                    'codebanque' => $request->codebanque,
                    'codeguichet' => $request->codeguichet,
                    'rib' => $request->rib,
                    // 'idproposition' => now(),
                    // 'codeproposition' => now(),
                    'branche' => Auth::user()->membre->branche,
                    
                    'partenaire' => Auth::user()->membre->codepartenaire,
                    // 'nomaccepterpar' => now(),
                    // 'refcontratsource' => now(),
                    'cleintegration' => "12012025",
                    // 'codeoperation' => now(),
                    // 'numeropolice' => now(),
                    Log::info("demarrage save cleintegration"),
                    'estpaye' => 0,
                    // 'pretconnexe' => now(),
                    // 'details' => now(),
                    'nomsouscipteur' => $idAdherent,
                    'typesouscipteur' => Auth::user()->membre->branche,
                    // 'numBullettin' => $numeroBulletin
                ])->save();


                $bulletinData = $this->generateBulletin($idContrat);

                // Si la génération du bulletin a échoué, lever une exception
                if (!$bulletinData['success']) {
                    throw new \Exception("Erreur lors de la génération du bulletin : " . $bulletinData['message']);
                }


                DB::commit();
    
                return response()->json([
                    'type' => 'success',
                    'urlback' => route('prod.edit', ['id' => $idContrat]),
                    'url' => $bulletinData['file_url'],
                    'message' => "Enregistré avec succès !",
                    'code' => 200,
                ]);
                
            } catch (\Throwable $th) {
                DB::rollBack();

                Log::error("Erreur système: ", ['error' => $th]);
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur système! $th",
                    'code' => 500,
                ]);
            }
    }

    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
        
    //     try {
    //         // Validation des données d'entrée
    //         $validatedData = $this->validateRequest($request);
    //         if (!$validatedData['success']) {
    //             return response()->json($validatedData);
    //         }

    //         // Génération du numéro de bulletin
    //         $numeroBulletin = RefgenerateBulletin(Contrat::class, 'SECURICPTE', 'numBullettin', '8301100011116');
    //         Log::info("numGenerer: " . $numeroBulletin);

    //         // Récupération du produit
    //         $product = Product::where('CodeProduit', $request->codeproduit)->firstOrFail();

    //         // Calcul des primes
    //         $prime = $request->primepricipale + $request->surprime + $request->fraisadhesion;
    //         $primeGarantie = $request->primepricipale + $request->surprime;

    //         // Création des IDs
    //         $ids = $this->generateIds();

    //         // Création de l'adhérent
    //         $adherent = $this->createAdherent($request, $ids['idAdherent']);
            
    //         // Gestion des assurés
    //         $this->handleAssures($request, $ids['idContrat'], $ids['idAdherent'], $primeGarantie);
            
    //         // Gestion des bénéficiaires
    //         $benefauterm = $this->handleBeneficiaires($request, $ids['idContrat'], $ids['idAdherent'], $ids['idBenef']);

    //         // Création du contrat
    //         $contrat = $this->createContrat($request, $ids['idContrat'], $ids['idAdherent'], $product, $prime, $numeroBulletin, $benefauterm);

    //         // Génération du bulletin
    //         $bulletinData = $this->generateBulletin($ids['idContrat']);
    //         if (!$bulletinData['success']) {
    //             throw new \Exception("Erreur lors de la génération du bulletin : " . $bulletinData['message']);
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'type' => 'success',
    //             'urlback' => route('prod.edit', ['id' => $ids['idContrat']]),
    //             'url' => $bulletinData['file_url'],
    //             'message' => "Enregistré avec succès !",
    //             'code' => 200,
    //         ]);
            
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         Log::error("Erreur système: ", ['error' => $th]);
            
    //         return response()->json([
    //             'type' => 'error',
    //             'urlback' => '',
    //             'message' => "Erreur système! " . $th->getMessage(),
    //             'code' => 500,
    //         ]);
    //     }
    // }

// Méthodes helper privées

private function validateRequest(Request $request): array
{
    // Implémentez la validation des données ici
    // Retourne un tableau avec 'success' => true/false et un message d'erreur si nécessaire
    return ['success' => true];
}

private function generateIds(): array
{
    return [
        'idAdherent' => Adherent::max('id') + 1,
        'idAssure' => Assurer::max('id') + 1,
        'idBenef' => Beneficiaire::max('id') + 1,
        'idContrat' => Contrat::max('id') + 1,
        'idDocument' => Document::max('id') + 1,
    ];
}

private function createAdherent(Request $request, int $idAdherent): Adherent
{
    $datenaissance = Carbon::parse($request->datenaissance)->format('Y-m-d H:i:s');
    $sexe = $request->civilite === "Monsieur" ? "M" : "F";

    return Adherent::create([
        'id' => $idAdherent,
        'civilite' => $request->civilite,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'datenaissance' => $datenaissance,
        'lieunaissance' => $request->lieunaissance,
        'sexe' => $sexe,
        'numeropiece' => $request->numeropiece,
        'naturepiece' => $request->naturepiece,
        'lieuresidence' => $request->lieuresidence,
        'profession' => $request->profession,
        'employeur' => $request->employeur,
        'pays' => $request->pays,
        'estmigre' => 0,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'telephone1' => $request->telephone1,
        'mobile' => $request->mobile,
        'codemembre' => 0,
        'mobile1' => $request->mobile1,
        'saisieLe' => now(),
        'saisiepar' => Auth::user()->membre->idmembre,
        'refcontratsource' => $request->refcontratsource,
        'cleintegration' => $request->cleintegration,
        'id_maj' => $request->id_maj,
        'connexe' => $request->connexe,
        'contratconnexe' => $request->contratconnexe,
        'capitalconnexe' => $request->capitalconnexe,
    ]);
}

private function handleAssures(Request $request, int $idContrat, int $idAdherent, float $primeGarantie): void
{
    // Gestion de l'assuré principal si c'est l'adhérent
    if ($request->estAssure === "Oui") {
        $this->createMainAssure($request, $idContrat, $idAdherent, $primeGarantie);
    }

    // Gestion des autres assurés
    $assures = json_decode($request->input('assures'), true);
    if ($assures) {
        foreach ($assures as $assure) {
            $this->createAdditionalAssure($assure, $idContrat, $idAdherent);
        }
    }
}

private function createMainAssure(Request $request, int $idContrat, int $idAdherent, float $primeGarantie): void
{
    $datenaissance = Carbon::parse($request->datenaissance)->format('Y-m-d H:i:s');
    $sexe = $request->civilite === "Monsieur" ? "M" : "F";
    $garanties = Garantie::where('codeproduit', $request->codeproduit)->get();

    $assure = Assurer::create([
        'id' => Assurer::max('id') + 1,
        'civilite' => $request->civilite,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'datenaissance' => $datenaissance,
        'lieunaissance' => $request->lieunaissance,
        'codecontrat' => $idContrat,
        'codeadherent' => $idAdherent,
        'sexe' => $sexe,
        'numeropiece' => $request->numeropiece,
        'naturepiece' => $request->naturepiece,
        'lieuresidence' => $request->lieuresidence,
        'profession' => $request->profession,
        'employeur' => $request->employeur,
        'pays' => $request->pays,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'telephone1' => $request->telephone1,
        'mobile' => $request->mobile,
        'codemembre' => 0,
        'mobile1' => $request->mobile1,
        'saisieLe' => now(),
        'saisiepar' => auth::user()->membre->idmembre,
    ]);

    foreach ($garanties as $garantie) {
        AssureGarantie::create([
            'codeproduitgarantie' => $garantie->codeproduitgarantie,
            'idproduitparantie' => $garantie->id,
            'monlibelle' => $garantie->libelle,
            'prime' => $request->primepricipale,
            'primetotal' => $request->primepricipale,
            'primeaccesoire' => 0,
            'type' => "Mixte",
            'capitalgarantie' => $request->capital,
            'tauxinteret' => $request->tauxinteret,
            'codeassure' => $assure->id,
            'codecontrat' => $idContrat,
            'estmigre' => 0,
        ]);
    }
}

private function createAdditionalAssure(array $assure, int $idContrat, int $idAdherent): void
{
    $datenaissanceAssur = isset($assure['datenaissance']) ? Carbon::parse($assure['datenaissance'])->format('Y-m-d H:i:s') : null;
    $sexeassur = ($assure['civilite'] ?? 'Monsieur') === "Monsieur" ? "M" : "F";

    Assurer::create([
        'id' => Assurer::max('id') + 1,
        'civilite' => $assure['civilite'],
        'nom' => $assure['nom'],
        'prenom' => $assure['prenom'],
        'datenaissance' => $datenaissanceAssur,
        'codecontrat' => $idContrat,
        'codeadherent' => $idAdherent,
        'lieunaissance' => $assure['lieuNaissance'],
        'numeropiece' => $assure['numeropiece'] ?? null,
        'naturepiece' => $assure['naturepiece'] ?? null,
        'lieuresidence' => $assure['lieuresidence'] ?? null,
        'filiation' => $assure['lienParente'],
        'mobile' => $assure['mobile'] ?? null,
        'estmigre' => $assure['estmigre'] ?? null,
        'email' => $assure['email'] ?? null,
        'sexe' => $sexeassur,
        'saisieLe' => now(),
        'saisiepar' => Auth::user()->membre->idmembre,
    ]);
}

private function handleBeneficiaires(Request $request, int $idContrat, int $idAdherent, int $idBenef): string
{
    $benefauterm = "autre";

    // Bénéficiaire = adhérent
    if ($request->addBeneficiary === "adherent") {
        $benefauterm = "adherent";
        $this->createAdherentBeneficiary($request, $idContrat, $idAdherent, $idBenef);
    }

    // Autres bénéficiaires
    $beneficiaires = json_decode($request->input('beneficiaires'), true);
    if ($beneficiaires) {
        foreach ($beneficiaires as $beneficiaire) {
            $this->createAdditionalBeneficiary($beneficiaire, $idContrat, $idAdherent);
        }
    }

    return $benefauterm;
}

private function createAdherentBeneficiary(Request $request, int $idContrat, int $idAdherent, int $idBenef): void
{
    $datenaissanceBenef = Carbon::parse($request->datenaissanceBenef)->format('Y-m-d H:i:s');
    
    Beneficiaire::create([
        'id' => $idBenef,
        'civilite' => $request->civilite,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'datenaissance' => $datenaissanceBenef,
        'codecontrat' => $idContrat,
        'codeadherent' => $idAdherent,
        'lieunaissance' => $request->lieunaissance,
        'numeropiece' => $request->numeropiece,
        'naturepiece' => $request->naturepiece,
        'lieuresidence' => $request->lieuresidence,
        'filiation' => $request->lienParente,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'saisieLe' => now(),
        'saisiepar' => Auth::user()->membre->idmembre,
    ]);
}

private function createAdditionalBeneficiary(array $beneficiaire, int $idContrat, int $idAdherent): void
{
    $datenaissanceBeneficiaire = isset($beneficiaire['dateNaissance']) ? Carbon::parse($beneficiaire['dateNaissance'])->format('Y-m-d H:i:s') : null;
    
    Beneficiaire::create([
        'id' => Beneficiaire::max('id') + 1,
        'civilite' => $beneficiaire['civilite'] ?? null,
        'nom' => $beneficiaire['nom'],
        'prenom' => $beneficiaire['prenom'],
        'datenaissance' => $datenaissanceBeneficiaire,
        'codecontrat' => $idContrat,
        'codeadherent' => $idAdherent,
        'lieunaissance' => $beneficiaire['lieuNaissance'],
        'numeropiece' => $beneficiaire['numeropiece'] ?? null,
        'naturepiece' => $beneficiaire['naturepiece'] ?? null,
        'lieuresidence' => $beneficiaire['lieuResidence'],
        'filiation' => $beneficiaire['lienParente'],
        'mobile' => $beneficiaire['telephone'],
        'email' => $beneficiaire['email'],
        'saisieLe' => now(),
        'saisiepar' => Auth::user()->membre->idmembre,
    ]);
}

private function createContrat(
    Request $request, 
    int $idContrat, 
    int $idAdherent, 
    Product $product, 
    float $prime, 
    // string $numeroBulletin,
    string $benefauterm
): Contrat {
    $numerocompte = $request->modepaiement === "Mobile_money" 
        ? $request->numMobile 
        : $request->numerocompte;

    return Contrat::create([
        'id' => $idContrat,
        'dateeffet' => $request->dateEffet,
        'modepaiement' => $request->modepaiement,
        'organisme' => $request->organisme,
        'agence' => $request->agence,
        'numerocompte' => $numerocompte,
        'periodicite' => $request->periodicite,
        'codeConseiller' => Auth::user()->membre->codeagent,
        'nomagent' => Auth::user()->membre->nom.' '.Auth::user()->membre->prenom,
        'primepricipale' => number_format($request->primepricipale, 2, ".", ""),
        'prime' => $prime,
        'fraisadhesion' => $request->fraisadhesion,
        'surprime' => $request->surprime,
        'capital' => number_format($request->capital, 2, ".", ""),
        'etape' => 1,
        'saisiele' => now(),
        'saisiepar' => Auth::user()->membre->idmembre,
        'duree' => $request->duree,
        'codeadherent' => $idAdherent,
        'estMigre' => 0,
        'codeproduit' => $request->codeproduit,
        // 'libelleproduit' => $product->MonLibelle,
        'libelleproduit' => 'SECURICOMPTE GTBANK',
        'personneressource' => $request->personneressource,
        'contactpersonneressource' => $request->contactpersonneressource,
        'beneficiaireauterme' => $benefauterm,
        'beneficiaireaudeces' => $request->audecesContrat,
        'personneressource2' => $request->personneressource2,
        'contactpersonneressource2' => $request->contactpersonneressource2,
        'codebanque' => $request->codebanque,
        'codeguichet' => $request->codeguichet,
        'rib' => $request->rib,
        'branche' => Auth::user()->membre->branche,
        'partenaire' => Auth::user()->membre->codepartenaire,
        'cleintegration' => "",
        'estpaye' => 0,
        'nomsouscipteur' => $idAdherent,
        'typesouscipteur' => Auth::user()->membre->branche,
        // 'numBullettin' => $numeroBulletin
    ]);
}

    private function generateBulletin($idContrat)
    {
        ini_set('memory_limit', '1024M');

        try {
            // Récupérer les données nécessaires au bulletin
            $contrat = Contrat::findOrFail($idContrat);

            // Options pour DomPDF
            $options = new Options();
            $options->set('isRemoteEnabled', true);

            // Génération du bulletin PDF temporaire
            $pdf = PDF::loadView('productions.components.bullettin.securCompt', [
                'contrat' => $contrat,
            ])
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

            $bulletinDir = public_path('documents/bulletin/');
            if (!is_dir($bulletinDir)) {
                mkdir($bulletinDir, 0777, true);
            }

            $tempBulletinPath = $bulletinDir . 'temp_bulletin_' . $contrat->id . '.pdf';
            $pdf->save($tempBulletinPath);

            // Chemin vers le fichier CGU
            // $cguFilePath = public_path('root/cgu/CGPLanggnant.pdf');
            $cguFilePath = public_path('root/cgu/CguCMF.pdf');

            // Initialiser FPDI pour fusionner les fichiers
            $finalPdf = new Fpdi();

            // Ajouter le bulletin au PDF final
            $finalPdf->AddPage();
            $finalPdf->setSourceFile($tempBulletinPath);
            $bulletinTplIdx = $finalPdf->importPage(1);
            $finalPdf->useTemplate($bulletinTplIdx);

            // Ajouter les pages du fichier CGU
            $cguPageCount = $finalPdf->setSourceFile($cguFilePath);
            for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                $finalPdf->AddPage();
                $cguTplIdx = $finalPdf->importPage($pageNo);
                $finalPdf->useTemplate($cguTplIdx);
            }

            // Nom final du fichier fusionné
            $finalBulletinPath = $bulletinDir . 'securCompt_bulletin_' . $contrat->id . '.pdf';
            $finalPdf->Output($finalBulletinPath, 'F');

            // Supprimer le fichier temporaire du bulletin
            unlink($tempBulletinPath);

            // Définir l'URL publique pour le fichier final
            $fileUrl = asset("documents/bulletin/securCompt_bulletin_{$contrat->id}.pdf");

            return [
                'success' => true,
                'file_url' => $fileUrl,
                'redirect_url' => route('prod.edit', ['id' => $idContrat]),
            ];
        } catch (\Exception $e) {
            Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function transmettreContrat($id)
    {
        DB::beginTransaction();
        try {
                $contrat = Contrat::find($id);
    
                if ($contrat) {
                    $contrat->update(
                        [
                            'transmisle' => now(),
                            'etape' => 2,
                            'transmispar' => Auth::user()->membre->idmembre
                        ]
                    );

                    DB::commit();
                
                    return response()->json([
                        'type' => 'success',
                        'urlback' => \route('prod.index'),
                        'message' => "Transmis avec succès!",
                        'code' => 200,
                    ]);
                } else {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => 'back',
                        'message' => "Erreur erreur de transmission !",
                        'code' => 200,
                    ]);
                }
       
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur système! $th",
                    'code' => 500,
                ]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        set_time_limit(300);
        $CodeProduit = Contrat::where('id', $id)->first()->codeproduit;
        $productGarantie = ProduitGarantie::where('CodeProduit',$CodeProduit)->get();

        $contrat = Contrat::where('id', $id)->first();

        return view('productions.show', compact('contrat', 'productGarantie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contrat = Contrat::where('id', $id)->with('adherent', 'assures', 'beneficiaires', 'produit', 'agenceBanque')->first();

        $productGarantie = ProduitGarantie::where('CodeProduit',$contrat->codeproduit)->get(); 
        $product = Product::where('CodeProduit',$contrat->codeproduit)->first(); 
        $villes =  TblVille::get();
        $professions =  TblProfession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  AgenceByParter::get();
        return view('productions.edit', compact('contrat', 'product', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences'));
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        try {

            if ($request->modepaiement === "Mobile_money") {
                $numerocompte = $request->numMobile;
            }else{
                $numerocompte = $request->numerocompte;
            }
            Contrat::where('id', $id)->update([
                'dateeffet' => $request->dateEffet,
                'modepaiement' => $request->modepaiement,
                'organisme' => $request->organisme,
                'agence' => $request->agence,
                'numerocompte' => $numerocompte,
                'codebanque' => $request->codebanque,
                'codeguichet' => $request->codeguichet,
                'rib' => $request->rib,
                'periodicite' => $request->periodicite,

                'primepricipale' => $request->primepricipale,
                'prime' => $request->primepricipale,

                'fraisadhesion' => $request->fraisadhesion,

                // 'surprime' => $request->surprime,
                
                'capital' => number_format($request->capital, 2, ".", ""),
                
                'duree' => $request->duree,
                
                // 'codeproduit' => $request->codeproduit,

                'modifierle' => now(),
                'modifierpar' => Auth::user()->membre->idmembre,

                'personneressource' => $request->personneressource,
                'contactpersonneressource' => $request->contactpersonneressource,
                'personneressource2' => $request->personneressource2,
                'contactpersonneressource2' => $request->contactpersonneressource2,

                // 'transmisle' => now(),
                // 'annulerle' => null,
                // 'accepterle' => null,
               
                // 'motifrejet' => null,
                // 'montantrente' => $request->montantrente,
                // 'periodiciterente' => $request->periodiciterente,
                // 'dureerente' => $request->dureerente,

            
                // 'beneficiaireauterme' => $benefauterm,
                // 'beneficiaireaudeces' => $request->audecesContrat,

                // 'accepterpar' => $idContrat,
                // 'rejeterpar' => $idAdherent,
                // 'transmispar' => $request->saisiepar,
                // 'capital' => $request->capital,
                
            ]);
            DB::commit();
            
            return response()->json([
                'type' => 'success',
                'urlback' => '',
                'message' => "Enregistré avec succès!",
                'code' => 200,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


// $files = $request->file('files');
//                 $libelles = $request->input('libelles');  // Récupérer les libellés

                
//                 foreach ($files as $key => $file) {
//                     $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
//                     $destinationPath = public_path('documents/files');
//                     $file->move($destinationPath, $imageName);
//                     $filePath = 'documents/files/' . $imageName;

//                     // \dd($libelles[$key]);

//                     Document::create([
//                         'codecontrat' => $idContrat,
//                         'filename' => $imageName,
//                         'libelle' => $libelles[$key],
//                         'saisiele' => now(),
//                         'saisiepar' => Auth::user()->membre->idmembre,
//                         'source' => "ES",
//                     ])->save();
//                 }