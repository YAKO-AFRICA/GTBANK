<?php

namespace App\Http\Controllers\Admin;

use PDF;

use Carbon\Carbon;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Pret;
use App\Models\Membre;
use App\Models\Assurer;
use App\Models\Contrat;
use App\Models\Product;
use setasign\Fpdi\Fpdi;
use App\Models\Adherent;
use App\Models\TblVille;
use App\Models\TblAgence;
use App\Models\Profession;
use App\Models\TblSociete;
use App\Models\TblDocument;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use App\Models\TblProfession;
use App\Models\AssureGarantie;
use App\Models\ProduitGarantie;
use App\Models\DeclarationSante;
use App\Models\TblSecteurActivite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EpretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function demoSimulateur()
    {
       
        return view('epret.newSimule');
    }
    public function index()
    {
        $user = Auth::user()->idmembre;
        $prets = Pret::orderBy('saisiele', 'desc')->with('adherent')->limit(10)->get();

        return view('epret.index', compact('prets'));
    }

    public function simulateur()    
    {

        return view('epret.simulateur');
    }

    public function storeSimulation(Request $request)
    {
        // Stockez les données dans la session
        session(['simulationData' => $request->all()]);

        return response()->json(['message' => 'Simulation data stored successfully']);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::where('CodeProduit', 'loyemp')->first();

        $productGarantie = ProduitGarantie::where('CodeProduit','loyemp')->get();
        $villes =  TblVille::select('libelleVillle')->get();
        $professions =  Profession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  TblAgence::select('NOM_LONG')->get();

        $simulationData = session('simulationData', []);


        return view('epret.create', compact('product', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences','simulationData'));
    }


    // public function saveBeneficiarySession(Request $request)
    // {
    //     $request->validate([
    //         'nomBenef' => 'required|string',
    //         'prenomBenef' => 'required|string',
    //         'datenaissanceBenef' => 'required|string',
    //         'lieunaissanceBenef' => 'required|string',
    //         'emailBenef' => 'required|email', // Correction ici
    //     ]);
    
    //     // Stocker les données dans la session
    //     $beneficiaryData = [
    //         'prenom' => $request->input('prenomBenef'),
    //         'nom' => $request->input('nomBenef'),
    //         'lieuresidence' => $request->input('lieuResidenceBenef'),
    //         'telephone' => $request->input('numPhoneBenef'),
    //         'email' => $request->input('emailBenef'),
    //         'datenaissance' => $request->input('datenaissanceBenef'),
    //         'lieunaissance' => $request->input('lieunaissanceBenef'),
    //     ];
    
    //     Session::put('beneficiaryDefault', $beneficiaryData);
    //     Log::info("Données sauvegardées dans la session : " . json_encode($beneficiaryData));
    
    //     return response()->json(['success' => true, 'message' => 'Bénéficiaire sauvegardé dans la session']);
    // }

    public function saveBeneficiarySession(Request $request)
    {
        // Validation des champs requis
        $validated = $request->validate([
            'nomBenef' => 'required|string|max:255',
            'prenomBenef' => 'required|string|max:255',
            'datenaissanceBenef' => 'required|date',
            'lieunaissanceBenef' => 'required|string|max:255',
            'lieuResidenceBenef' => 'required|string|max:255',
            'numPhoneBenef' => 'required|string|max:20',
            'emailBenef' => 'required|email|max:255',
            'capitalBenef' => 'required|numeric'
        ]);

        // Stocker les données dans la session
        Session::put('beneficiaryDefault', $validated);
        Log::info("Données sauvegardées dans la session : " . json_encode($validated));

        return response()->json(['success' => true, 'message' => 'Bénéficiaire sauvegardé dans la session']);
    }

    


    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {

            DB::beginTransaction();
            try {


                $sexe = $request->civilite === "Monsieur" ? "M" : "F";
                $datenaissance = Carbon::parse($request->datenaissance)->format('Y-m-d H:i:s');

                $idAdherent = Adherent::max('id') + 1;
                $idPret = Pret::max('id') + 1;
                $idBenef = Beneficiaire::max('id') + 1;
                $idGarantie = AssureGarantie::max('id') + 1;
                $idGarantieTwo = $idGarantie + 1;
                $idAssurer = Assurer::max('id') + 1;

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
                    'cleintegration' => "040225",
                    'id_maj' => $request->id_maj,
                    'connexe' => $request->connexe,
                    'contratconnexe' => $request->contratconnexe,
                    'capitalconnexe' => $request->capitalconnexe
                ])->save();

                Assurer::create([
                    'id' => $idAssurer,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $datenaissance,
                    'codecontrat' => $idPret,
                    'codeadherent' => $idAdherent,
                    'lieunaissance' => $request->lieunaissance,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece ?? null,
                    'lieuresidence' => $request->lieuresidence ?? null,
                    // 'filiation' => $assure['lienParente'],
                    'mobile' => $request->mobile ?? null,
                    'estmigre' => 0 ?? null,
                    'email' => $request->email ?? null,
                    'sexe' => $sexe,
                    'saisieLe' => now(),
                    'saisiepar' => auth::user()->membre->idmembre,
                ]);

                Log::info($Adherent);

                if($request->primeObseque != null){
                    $disableYako = 0;
                }else{
                    $disableYako = 1;
                }
                $commonData = [
                    'codeassure' => $idAssurer,
                    'codecontrat' => $idPret,
                    'estmigre' => 0,
                    'refcontratsource' => $idPret,
                    'codeoperation' => 00,
                ];
                
                $garanties = [
                    [
                        'id' => $idGarantie,
                        'codeproduitgarantie' => "DECES",
                        'idproduitparantie' => 59,
                        'monlibelle' => 'DECES',
                        'prime' => 5000,
                        'primeaccesoire' => 0,
                        'primetotal' => 5000,
                        'type' => "Mixte",
                        'capitalgarantie' => "500000",
                    ],
                    [
                        'id' => $idGarantieTwo,
                        'codeproduitgarantie' => "YKEMP",
                        'idproduitparantie' => 153,
                        'monlibelle' => 'Yako Emprunteur',
                        'prime' => 0,
                        'primeaccesoire' => 0,
                        'primetotal' => 0,
                        'type' => "Mixte",
                        'capitalgarantie' => "0",
                    ],
                ];
                
                foreach ($garanties as $garantie) {
                    AssureGarantie::create(array_merge($garantie, $commonData))->save();
                }
   

                $newPret = Pret::create([
                    'id' => $idPret,
                    'typepret' => $request->typPret,
                    'effetgarantie' => $request->loanDateMiseEnPlace,
                    'montantpret' => $request->montant,
                    'dateecheancedebut' => $request->firstDateEcheance,
                    'dateecheancefin' => $request->lasLoanDateRembour,

                    'remboursement' => $request->periodiciterRembou,
                    'numerocompte' => $request->numerocompte,

                    'txprimeunique' => $request->txprimeunique,
                    'txsurprime' => $request->txsurprime,
                    'txprimedef' => $request->txprimedef,

                    'prime' => $request->prime, // totzl desprimes plus surplus

                    'primeht' => $request->primeEmprunteur,

                    'montantsurprime' => $request->montantsurprime,
                    'fraisaccessoires' => $request->fraisaccessoires,
                    'fraismedicaux' => $request->fraismedicaux,
                    'duree' => $request->duree,

                    'taille' => $request->taille,
                    'poids' => $request->poids,

                    'partenaire' => Auth::user()->membre->codepartenaire,
                    'periodicite' => $request->periodiciterPrime,
                    'tension' => $request->tensionMin,
                    'fumezvous' => $request->smoking,
                    'nbcigarettejour' => $request->nbcigarettejour,
                    'buvezvous' => $request->alcohol,
                    'distraction' => $request->distractions,
                    'estinfirme' => $request->accident,

                    // 'natureinfirmite' => $request->natureinfirmite,

                    // 'estenarrettravail' => $request->estenarrettravail,
                    // 'datearrettravail' => $request->datearrettravail,
                    // 'motifarret' => $request->motifarret,


                    // 'datereprisetravail' => $request->datereprisetravail,
                    // 'causearrettravail' => $request->causearrettravail,
                    // 'datecausetravail' => $request->datecausetravail,

                    'saisiele' => now(),
                    'saisiepar' => Auth::user()->idmembre,   
                    'codeagent' => Auth::user()->membre->codeagent,
                    'nomagent' => Auth::user()->membre->nom.''.Auth::user()->membre->prenom,

                    'encotation' => 0,

                    'etat' => 1,
                    'codeadherent' => $idAdherent,
                    'estmigre' => 0,

                    // 'examens' => $request->examens,
                    // 'codebanque' => $request->codebanque,
                    // 'codeguichet' => $request->codeguichet,
                    // 'agence' => $request->agence,

                    // 'tarificationmedicale' => $request->tarificationmedicale,
                    // 'datemiseenplace' => $request->datemiseenplace,
                    // 'misenplacepar' => $request->misenplacepar,
                    // 'daterejet' => $request->daterejet,
                    // 'rejeterpar' => $request->rejeterpar,
                    // 'referencepret' => $request->referencepret,
                    // 'moftifrejet' => $request->moftifrejet,
                    // 'modifiele' => $request->modifiele,
                    // 'modifierpar' => $request->modifierpar,


                    'primeobseque' => $request->primeObseque,

                    // 'motifcotation' => $request->motifcotation,

                    'capital' => 500000,

                    // 'beneficiaireaudeces' => $request->beneficiaireaudeces,

                    'personneressource' => $request->personneressource,
                    'contactpersonneressource' => $request->contactpersonneressource,
                    'personneressource2' => $request->personneressource2,
                    'contactpersonneressource2' => $request->contactpersonneressource2,

                    // 'rib' => $request->rib,

                    'estsportif' => $request->sport,
                    'sportpratique' => $request->typeSport,

                    // 'miseenplaceeffective' => $request->miseenplaceeffective,
                    // 'motifrachat' => $request->motifrachat,
                    // 'daterachat' => $request->daterachat,
                    // 'racheterpar' => $request->racheterpar,

                    // 'medecin' => $request->medecin,

                    // 'rapportmedicalok' => $request->rapportmedicalok,
                    // 'daterapportmedical' => $request->daterapportmedical,

                    'primerisque' => $request->primeRisque,
                    'primeemprunteur' => $request->primeEmprunteur,

                    'numeroclient' => $request->numeroclient,

                    'typeadherent' => 'Individuel',
                    // 'nbadherent' => $request->nbadherent,

                    'unableyako' => $disableYako,

                    // 'rmedicinok' => $request->rmedicinok,
                    // 'datermedecin' => $request->datermedecin,
                    // 'daterapport' => $request->daterapport,
                    // 'dateemis' => $request->dateemis,
                    'naturepret' => $request->naturePret,
                    // 'daterejetmedecin' => $request->daterejetmedecin,
                    // 'etatmedicin' => $request->etatmedicin,
                    
                ]);

                $santeData = DeclarationSante::create([
                    'taille' => $request->taille,
                    'poids' => $request->poids,
                    'tensionMin' => $request->tensionMin,
                    'tensionMax' => $request->tensionMax,
                    'smoking' => $request->smoking,
                    'alcohol' => $request->alcohol,
                    'sport' => $request->sport,
                    'typeSport' => $request->typeSport,
                    'accident' => $request->accident,
                    'treatment' => $request->treatment, // trantement medical 6 dernier mois
                    'transSang' => $request->transSang, // transfusion de sang 6 dernier mois
                    'interChirugiale' => $request->interChirugiale, // intervention chirurgicaledeja subit
                    'prochaineInterChirugiale' => $request->prochaineInterChirugiale, // intervention chirurgicale prochaine
                    'diabetes' => $request->diabetes,
                    'hypertension' => $request->hypertension,
                    'sickleCell' => $request->sickleCell,
                    'liverCirrhosis' => $request->liverCirrhosis,
                    'lungDisease' => $request->lungDisease,
                    'cancer' => $request->cancer,
                    'anemia' => $request->anemia,
                    'kidneyFailure' => $request->kidneyFailure,
                    'stroke' => $request->stroke,
                    'codePret' => $idPret
                    
                ]);

                $beneficiary = new Beneficiaire();
                // $beneficiary->id = $idBenef + 1;
                $beneficiary->prenom = "CORIS";
                $beneficiary->nom = "CORIS";
                $beneficiary->lieuresidence = "SIEGE CORIS";
                $beneficiary->telephone = "0000000000";
                $beneficiary->email = "0HqKk@example.com";
                $beneficiary->save();
            



                $beneficiairesPret = Session::get('beneficiairesPret', []);

                Log::info("Beneficiaires reçus:", $beneficiairesPret);

    
                // Log::info("Beneficiaires reçus:", $beneficiairesPret);
                if ($request->primeObseque != null && $beneficiairesPret != null) {

                    foreach ($beneficiairesPret as $beneficiaire) {
                        $idBenefAdd = Beneficiaire::max('id') + 1;
                        $datenaissanceBenef = Carbon::parse($beneficiaire['date_naissance'])->format('Y-m-d H:i:s');
                        Beneficiaire::create([
                            'id' => $idBenefAdd,
                            'codepret' => $idPret,
                            'nom' => $beneficiaire['nom'],
                            'prenom' => $beneficiaire['prenom'],
                            'datenaissance' => $datenaissanceBenef,
                            'lieunaissance' => $beneficiaire['lieu_naissance'],
                            'telephone' => $beneficiaire['telephone'],
                            'email' => $beneficiaire['email'],
                            'capital' => $beneficiaire['capital'],
                        ])->save();
                    }

          
                    Session::forget('beneficiairesPret');
                }

                DB::commit();

                Log::info("identifiaznt du pret" .$idPret);

                $bulletinData = $this->generateBulletinPret($idPret);


                Log::info($newPret);
                Log::info($bulletinData);


                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => '',
                    'url' => $bulletinData['file_url'],
                    'message' => "Enregistrer avec success !",
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

        private function generateBulletinPret($idPret)
        {
            try {
                // ini_set('memory_limit', '1024M');

                $pret = Pret::where('id', $idPret)->with('sante')->first();
                Log::info("id du pret " . $idPret);
                Log::info("pret trouverddddd " . $pret);

                if (!$pret) {
                    return response()->json(['success' => false, 'message' => 'Prêt non trouvé.'], 404);
                }

                // Options pour DomPDF
                $options = new Options();
                $options->set('isRemoteEnabled', true);

                // Génération du bulletin PDF temporaire
                $pdf = PDF::loadView('epret.components.bulletin.adhesion', ['pret' => $pret]);

                // Création du dossier si nécessaire
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                // Sauvegarde temporaire du bulletin
                $tempBulletinPath = $bulletinDir . 'temp_bulletin_' . $pret->id . '_' . now()->timestamp . '.pdf';
                $pdf->save($tempBulletinPath);

                // Chemin vers le fichier CGU
                $cguFilePath = public_path('root/cgu/CguLoyemp.pdf');
                if (!file_exists($cguFilePath)) {
                    Log::error("Le fichier CGU est introuvable : " . $cguFilePath);
                    return [
                        'success' => false,
                        'message' => 'Fichier CGU introuvable.',
                    ];
                }

                // Initialiser FPDI pour fusionner les fichiers
                $finalPdf = new Fpdi();
                
                // Ajouter le bulletin au PDF final
                $bulletinPageCount = $finalPdf->setSourceFile($tempBulletinPath);
                for ($pageNo = 1; $pageNo <= $bulletinPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $bulletinTplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($bulletinTplIdx);
                }

                // Ajouter les pages du fichier CGU
                $cguPageCount = $finalPdf->setSourceFile($cguFilePath);
                for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $cguTplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($cguTplIdx);
                }

                // Nom final du fichier fusionné
                $finalBulletinPath = $bulletinDir . 'adhesion_bulletin_' . $pret->id . '.pdf';
                $finalPdf->Output($finalBulletinPath, 'F');

                // Supprimer le fichier temporaire du bulletin après fusion
                if (file_exists($tempBulletinPath)) {
                    unlink($tempBulletinPath);
                }

                // Générer l'URL du fichier
                $fileUrl = asset("documents/bulletin/adhesion_bulletin_{$pret->id}.pdf");

                // Log de l'URL générée
                Log::info("Bulletin généré avec succès : " . $fileUrl);

                return [
                    'success' => true,
                    'file_url' => $fileUrl,
                ];
            } catch (\Exception $e) {
                // Enregistrer une erreur dans les logs
                Log::error("Erreur lors de la génération du bulletin : " . $e->getMessage());

                return [
                    'success' => false,
                    'message' => $e->getMessage(),
                ];
            }
        }


        public function printLoanBia($idPret)
        {
            try {

                // ini_set('memory_limit', '1024M');

                // Récupérer les données nécessaires au bulletin
                $pret = Pret::where('id', $idPret)->with('sante')->first();
                if (!$pret) {
                    return response()->json(['success' => false, 'message' => 'Prêt non trouvé.'], 404);
                }

                // Options pour DomPDF
                $options = new Options();
                $options->set('isRemoteEnabled', true);

                // Génération du bulletin PDF temporaire
                $pdf = PDF::loadView('epret.components.bulletin.adhesion', ['pret' => $pret]);

                // Création du dossier si nécessaire
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                // Sauvegarde temporaire du bulletin
                $tempBulletinPath = $bulletinDir . 'temp_bulletin_' . $pret->id . '_' . now()->timestamp . '.pdf';
                $pdf->save($tempBulletinPath);

                // Chemin vers le fichier CGU
                $cguFilePath = public_path('root/cgu/CguLoyemp.pdf');
                if (!file_exists($cguFilePath)) {
                    Log::error("Le fichier CGU est introuvable : " . $cguFilePath);
                    return response()->json(['success' => false, 'message' => 'Fichier CGU introuvable.'], 404);
                }

                // Initialiser FPDI pour fusionner les fichiers
                $finalPdf = new Fpdi();
                $finalPdf->AddPage();

                // Ajouter le bulletin au PDF final
                $bulletinPageCount = $finalPdf->setSourceFile($tempBulletinPath);
                if ($bulletinPageCount > 0) {
                    $bulletinTplIdx = $finalPdf->importPage(1);
                    $finalPdf->useTemplate($bulletinTplIdx);
                } else {
                    Log::error("Erreur lors de l'importation du bulletin : Aucune page trouvée.");
                    return response()->json(['success' => false, 'message' => 'Erreur dans le fichier bulletin.'], 500);
                }

                // Ajouter les pages du fichier CGU
                $cguPageCount = $finalPdf->setSourceFile($cguFilePath);
                for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $cguTplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($cguTplIdx);
                }

                // Nom final du fichier fusionné
                $finalBulletinPath = $bulletinDir . 'adhesion_bulletin_' . $pret->id . '.pdf';
                $finalPdf->Output($finalBulletinPath, 'F');

                // Supprimer le fichier temporaire du bulletin après fusion
                if (file_exists($tempBulletinPath)) {
                    unlink($tempBulletinPath);
                }

                return response()->make(file_get_contents($finalBulletinPath), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($finalBulletinPath) . '"'
                ]);
                
            } catch (\Exception $e) {
                Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e->getMessage()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur s\'est produite lors de la génération du bulletin.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }


       
        public function generateBu()
        {
            try {

                // $pret = Pret::where('id', '1637')->with('sante', 'beneficiaires')->first();
                $contrat = Contrat::where('id', '1')->first();

                // Chargement de la vue avec les données
                $pdf = PDF::loadView('productions.components.bullettin.assurCompte', ['contrat' => $contrat]);

                // Option 1 : Retourner directement le PDF pour téléchargement
                return $pdf->stream('bulletin_proposition.pdf');

            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => $e->getMessage(),
                ];
            }
        }

        public function addDocDefaud(Request $request)
        {
            try {
            DB::beginTransaction();
                $lastPret = Pret::where('saisiepar', Auth::user()->idmembre)
                ->latest('id')
                ->first();
                $idPret = $lastPret->id;

                $libelles = $request->input('libelles');
                $files = $request->file('files');
             
                foreach ($files as $key => $file) {
                    $imageName = $idPret . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
        
                    // $destinationPath = public_path('documents/files');
                    $destinationPath = base_path(env('UPLOADS_PATH'));
                    $file->move($destinationPath, $imageName);
                    // $filePath = env('UPLOADS_PATH') . $imageName;
                    $filePath = env('UPLOADS_PATH') . $imageName;

                    TblDocument::create([
                        'codecontrat' => $idPret,
                        'filename' => $imageName,
                        'libelle' => $libelles[$key],
                        'saisiele' => now(),
                        'saisiepar' => Auth::user()->membre->idmembre,
                        'source' => "ES",
                    ]);
                }
    
                DB::commit();
            
                return response()->json([
                    'type' => 'success',
                    'urlback' => route('epret.show', $idPret),
                    'message' => "Enregistré avec succès!",
                    'code' => 200,
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json([
                    'type' => 'error',
                    'urlback' => 'back',
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
            $productGarantie = ProduitGarantie::where('CodeProduit','loyemp')->get();

            $pret = Pret::where('id',$id)->firstOrFail();

            // dd($pret);
            
            return view('epret.show', compact('pret', 'productGarantie'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {


            $product = Product::where('CodeProduit', 'loyemp')->first();

            $pret = Pret::where('id', $id)->with('adherent', 'assures', 'beneficiaires')->first();
            $productGarantie = ProduitGarantie::where('CodeProduit',$pret->codeproduit)->get(); 
            $villes =  TblVille::get();
            $professions =  TblProfession::select('MonLibelle')->get();
            $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
            $societes =  TblSociete::select('MonLibelle')->get();
            $agences =  TblAgence::select('NOM_LONG')->get();
            return view('epret.edit', compact('pret', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences','product'));

        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {

            DB::beginTransaction();
            try {

                $newPret = Pret::where('id', $id)->update([

                    'naturepret' => $request->naturePret,
                    'typepret' => $request->typPret,
                    'effetgarantie' => $request->loanDateMiseEnPlace,
                    'dateecheancefin' => $request->lasLoanDateRembour,
                    'periodicite' => $request->periodiciterPrime,
                    'remboursement' => $request->periodiciterRembou,
                    'dateecheancedebut' => $request->firstDateEcheance,
                    // 'surprime' => $request->surprime,
                    
                ]);
                

                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => '',
                    'message' => "enregistrer avec success !",
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


        public function transmettrePret($id)
        {
            DB::beginTransaction();
            try {
                    $pret = Pret::find($id);
        
                    if ($pret) {
                        $contrat = Contrat::create([
                            'dateeffet'          => $pret->effetgarantie,
                            'modepaiement'       => "SOURCE",
                            'organisme'          => 'CORIS',
                            'prime'              => $pret->prime,
                            'capital'            => $pret->montantpret,
                            'fraisadhesion'      => $pret->primerisque,
                            'etape'              => 2,
                            'numerocompte'       => $pret->numerocompte,
                            'saisiele'           => $pret->saisiele,
                            'saisiepar'          => $pret->saisiepar,
                            'estMigre'           => 0,
                            'estpaye'            => 0,
                            'codeadherent'       => $pret->codeadherent,
                            'codeconseiller'     => $pret->codeagent,
                            'nomagent'           => $pret->nomagent,
                            'duree'              => $pret->duree,
                            'periodicite'        => 'U',
                            'codeproduit'        => 'loyemp',
                            'primepricipale'     => $pret->prime,
                            'libelleproduit'     => 'loyale emprunteur coris',
                            'transmisle'         => $pret->saisiele,
                            'branche'            => 'BANKASS',
                            'partenaire'         => 'CORIS',
                            'refcontratsource'   => $pret->id,
                            'cleintegration'     => now()->format('Y-m-d'),
                            'pretconnexe'        => $pret->id,
                            'nomsouscipteur'        => $pret->numeroclient,
                        ]);

                        $pret->update(
                            [
                                'etat' => 2,
                                'estmigre' => 1,
                            ]
                        );

                        DB::commit();
                    
                        return response()->json([
                            'type' => 'success',
                            'urlback' => \route('epret.index'),
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
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            DB::beginTransaction();
            try 
            {
                $pret = Pret::find($id);
                if ($pret) {

                    $pret->delete();

                    DB::commit();

                    return response()->json([
                        'type' => 'success',
                        'urlback' => "back",
                        'message' => "Suppression effectuée avec succès!",
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
}