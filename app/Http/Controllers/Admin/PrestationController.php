<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tblotp;
use Illuminate\Http\Request;
use App\Models\TblPrestation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TblDocPrestation;
use App\Models\TblTypePrestation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Membre;
use App\Models\MembreContrat;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $prestations = TblPrestation::where('etat', 'Actif')->with('docPrestation', 'otp', 'membre')->get();
        // dd($prestations);
        return view('prestations.index');
    }

    public function selectPrestation()
    {
        $typePrestations = TblTypePrestation::where('etat', 'Actif')->get();
        $contract = session('contractDetails', []);
        $contractDetails = $contract['details'][0] ?? [];
        $membreDetails   = $contract['membre'] ?? [];
        // dd($contractDetails, $membreDetails);
        return view('prestations.selectPrestation', compact('typePrestations', 'contractDetails'));
    }
    // $cMembre   = MembreContrat::where('idcontrat', 2259833)->first();
    // $membre = Membre::where('idmembre', $cMembre->codemembre)->first();
    // dd($membre);

    // dd($membre);
    // $membreContrat = MembreContrat::where('idcontrat', 2259833)->with('membre')->first();

    // if ($membreContrat) {
    //     $membre = $membreContrat->membre;
    //     dd($membre); // Vérifiez les données du membre
    // } else {
    //     dd('Aucun contrat trouvé.');
    // }

    /**
     * Show the form for creating a new resource.
     */
    
    public function printFichePrestation()
    {
        // $prestation = TblPrestation::where('id', $id)->first();
        // Génération de QR Code en base64
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate("http://yakoafrica_live.test/espace-client/prestation/getInfoPrestation/1"));
        $pdf = Pdf::loadView('prestations.fiches.prestationtest', compact('qrcode'))
        ->setPaper('a4', 'portrait')
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, // Permet le chargement des ressources distantes si nécessaire
            'margin-left' => 0,
            'margin-right' => 0,
            'margin-top' => 0,
            'margin-bottom' => 0,
        ]);
  
        $fileName = 'Prestation.pdf';
        return $pdf->stream($fileName);
        // $PrestationDir = public_path('documents/prestations/');
        // if (!is_dir($PrestationDir)) {
        //     mkdir($PrestationDir, 0777, true);
        // }
        // $pdf->save($PrestationDir . $fileName);
        // return view('users.espace_client.services.fiches.prestation');
    }
    public function getInfoPrestation(string $id)
    {
        $prestation = TblPrestation::where('id', $id)->first();
        // dd($prestation);
        return view('prestations.fiches.infoPrestByQrcode', compact('prestation'));
    }
    public function fetchContractDetails(Request $request)
{
    $idcontrat = $request->input('idcontrat');
    // dd($idcontrat);
    if (!$idcontrat) {
        return response()->json([
            'status' => 'error',
            'message' => 'Aucun contrat sélectionné.',
        ], 400);
    }

    try {
        // Utiliser Guzzle directement pour un meilleur contrôle
        $response = Http::withOptions(['timeout' => 60,])->post('https://api.yakoafricassur.com/oldweb/encaissement-bis', ['idContrat' => $idcontrat]);
        
        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'data' => $response->json(),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Impossible de récupérer les informations du contrat.',
            ], $response->status());
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
        ], 500);
    }
}
public function create(string $id)
    {
        $typePrestation = TblTypePrestation::where('id', $id)->first();
        $contract = session('contractDetails', []);
        $contractDetails = $contract['details'][0] ?? [];
        $membreDetails   = $contract['membre'] ?? [];
        // dd($contractDetails);
        // $membreDetails = session('membreDetails', []);

        // dd($contractDetails, $membreDetails);
        if (empty($contract)) {
            return redirect()->back()->withErrors('Les détails du contrat sont introuvables.');
        }

        return view('prestations.create', compact('typePrestation', 'contractDetails', 'membreDetails'));
    }
    public function fetchCustomerDetails(Request $request)
    {
        $idcontrat = $request->input('idcontrat');

        if (!$idcontrat) {
            return redirect()->back()->withErrors('Veuillez saisir un ID de contrat valide.');
    }

    try {
        $response = Http::withOptions(['timeout' => 60])
            ->post('https://api.yakoafricassur.com/oldweb/encaissement-bis', [
                'idContrat' => $idcontrat,
            ]);
        $contractMembre   = MembreContrat::where('idcontrat', $idcontrat)->with('membre')->first();

        if ($response->successful()) {
            $data = $response->json();
            $data['membre'] = $contractMembre->membre;

            if (!empty($data['details'])) {
                // Stocker les informations dans la session pour l'utiliser après redirection
                session(['contractDetails' => $data]);
                // session(['membreDetails' => $data['membre']]);
                return redirect()->route('prestation.selectPrestation');
            }

            return redirect()->back()->withErrors('Aucun détail trouvé pour ce contrat.');
        }

        return redirect()->back()->withErrors('Erreur : Impossible de récupérer les informations du contrat.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors('Une erreur s\'est produite : ' . $e->getMessage());
    }
}
    /**
     * Store a newly created resource in storage.
     */
    // public function generate () {

    // 	# 2. On génère un QR code de taille 200 x 200 px
    // 	$qrcode = QrCode::size(150)->generate("Je suis un QR Code");
    	
    // 	# 3. On envoie le QR code généré à la vue "simple-qrcode"
    // 	return view("users.espace_client.services.fiches.qrcode", compact('qrcode'));
    // }
    public function store(Request $request)
{

    DB::beginTransaction();
    try {
        $saisiepar = auth()->user()->idmembre;
        $otp = $request->otp_1.$request->otp_2.$request->otp_3.$request->otp_4.$request->otp_5.$request->otp_6;
        $idOtp = Tblotp::select('id')->where('codeOTP', $otp)->first();
        // Création de la prestation
        $prestation = TblPrestation::create([
            'code' => RefgenerateCodePrest(TblPrestation::class, 'PREST-', 'code'),
            'idOtp' => $idOtp->id ?? null,
            'idcontrat' => $request->idcontrat,
            'typeprestation' => $request->typeprestation,
            'idclient' => $request->idclient,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'datenaissance' => $request->datenaissance,
            'lieunaissance' => $request->lieunaissance,
            'sexe' => $request->sexe,
            'cel' => $request->cel,
            'tel' => $request->tel,
            'email' => $request->email,
            'msgClient' => $request->msgClient,
            'lieuresidence' => $request->lieuresidence,
            'montantSouhaite' => $request->montantSouhaite,
            'moyenPaiement' => $request->moyenPaiement,
            'Operateur' => $request->Operateur,
            'telPaiement' => $request->TelPaiement,
            'IBAN' => $request->IBAN,
            'saisiepar' => $saisiepar,
            // 'villedeclaration' => $request->villedeclaration,
            // 'mailtraitement' => $request->mailtraitement,
        ]);

        // Vérification si la prestation a été créée
        if (!$prestation) {
            throw new \Exception("Erreur lors de l'enregistrement de la prestation");
        }

        // if ($request->hasFile('libelle')) {
        //     foreach ($request->file('libelle') as $index => $file) {
        //         // Récupérer le type (par exemple 'image', 'pdf', etc.)
        //         $fileType = $request->type[$index]; 
        //         $contrat = $request->idcontrat;
        //         // Générer un nom de fichier unique avec la date, l'heure et le type
        //         $fileName = Carbon::now()->format('Ymd_His') . '_'.$contrat.'_' . $fileType . '.' . $file->extension();
        
        //         // Déplacer le fichier dans le répertoire "documents" dans le stockage public
        //         $file->move(public_path('documents/'), $fileName);
        
        //         // Enregistrer les informations du document dans la base de données
        //         TblDocPrestation::create([
        //             'idPrestation' => $prestation->id,
        //             'libelle' => $fileName, // Enregistrez le chemin du fichier dans la base de données
        //             'type' => $fileType, // Correspondance des types
        //         ]);
        //     }
        // }

        // if ($request->hasFile('libelle')) {
        //     $contrat = $request->idcontrat;
        //     $rectoFile = null;
        //     $versoFile = null;
        //     $prestationFiles = [];
            
        //     foreach ($request->file('libelle') as $index => $file) {
        //         $fileType = $request->type[$index];
        //         if ($fileType === 'CNIrecto') {
        //             $rectoFile = $file;
        //         } elseif ($fileType === 'CNIverso') {
        //             $versoFile = $file;
        //         } else {
        //             $fileName = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
        //             $file->move(public_path('documents/'), $fileName);
        //             $prestationFiles[] = [
        //                 'idPrestation' => $prestation->id,
        //                 'libelle' => $fileName,
        //                 'type' => $fileType,
        //             ];
        //         }
        //     }
            
        //     // Si les fichiers recto et verso sont présents
        //     if ($rectoFile && $versoFile) {
        //         $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI.pdf';
        //         $mergedFilePath = public_path('documents/') . $mergedFileName;
                
        //         $imagick = new Imagick();
        
        //         // Ajouter le recto
        //         $imagick->readImage($rectoFile->getPathname());
        //         $imagick->setImageFormat('pdf');
                
        //         // Ajouter le verso
        //         $imagick->readImage($versoFile->getPathname());
        //         $imagick->setImageFormat('pdf');
                
        //         // Fusionner les deux fichiers en un seul
        //         $imagick->writeImages($mergedFilePath, true);
        
        //         // Enregistrer dans la base de données
        //         $prestationFiles[] = [
        //             'idPrestation' => $prestation->id,
        //             'libelle' => $mergedFileName,
        //             'type' => 'CNI',
        //         ];
        //     }
        
        //     // Enregistrer tous les fichiers
        //     foreach ($prestationFiles as $fileData) {
        //         TblDocPrestation::create($fileData);
        //     }
        // }

        if ($request->hasFile('libelle')) {
            $contrat = $request->idcontrat;
            $rectoFile = null;
            $versoFile = null;
            $prestationFiles = [];
            
            foreach ($request->file('libelle') as $index => $file) {
                $fileType = $request->type[$index];
                if ($fileType === 'CNIrecto') {
                    $rectoFile = $file;
                } elseif ($fileType === 'CNIverso') {
                    $versoFile = $file;
                } else {
                    $fileName = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
                    $file->move(public_path('documents/docsPrestation/'), $fileName);
                    $prestationFiles[] = [
                        'idPrestation' => $prestation->id,
                        'libelle' => $fileName,
                        'type' => $fileType,
                    ];
                }
            }
            
            // Si les fichiers recto et verso sont présents
            if ($rectoFile && $versoFile) {
                $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_'.$contrat.'.pdf';
                $mergedFilePath = public_path('documents/docsPrestation/') . $mergedFileName;
        
                // Charger les fichiers recto et verso
                $rectoContent = file_get_contents($rectoFile->getPathname());
                $versoContent = file_get_contents($versoFile->getPathname());
        
                // Créer une vue HTML pour le PDF
                $html = view('prestations.fiches.cni', [
                    'rectoContent' => base64_encode($rectoContent), 
                    'versoContent' => base64_encode($versoContent)
                ])->render();
        
                // Générer le PDF
                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                $pdf->save($mergedFilePath);
        
                // Enregistrer dans la base de données
                $prestationFiles[] = [
                    'idPrestation' => $prestation->id,
                    'libelle' => $mergedFileName,
                    'type' => 'CNI',
                ];
            }
        
            // Enregistrer tous les fichiers
            foreach ($prestationFiles as $fileData) {
                TblDocPrestation::create($fileData);
            }
        }
        
        

        // $PrestationDir = public_path('documents/prestations/');
        // if (!is_dir($PrestationDir)) {
        //     mkdir($PrestationDir, 0777, true);
        // }
        // $fileName = 'Prestation.pdf';
        // $pdf->save($PrestationDir . $fileName);
        // return $pdf->stream($fileName);
        
        // DB::commit();

        // return response()->json([
        //     'type' => 'success',
        //     'urlback' => "back",
        //     'message' => "Enregistré avec succès!",
        //     'code' => 200,
        // ]);
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate("http://ynov_next.test/prestation/getInfoPrestation/{$prestation->id}"));
        $pdf = Pdf::loadView('prestations.fiches.prestation', compact('qrcode', 'prestation'))
        ->setPaper('a4', 'portrait')
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, // Permet le chargement des ressources distantes si nécessaire
            'margin-left' => 0,
            'margin-right' => 0,
            'margin-top' => 0,
            'margin-bottom' => 0,
        ]);
        $PrestationDir = public_path('documents/prestations/');
        if (!is_dir($PrestationDir)) {
            mkdir($PrestationDir, 0777, true);
        }
        $fileName = 'Prestation_' . $prestation->code . '.pdf';
        $filePath = $PrestationDir . $fileName;
        $pdf->save($filePath);

        // URL publique du PDF
        $fileUrl = asset('documents/prestations/' . $fileName);

        DB::commit();

        return response()->json([
            'type' => 'success',
            'urlback' => $fileUrl, // URL du PDF
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
     * Display the specified resource.
     */

    

    public function mesPrestations()
    {
        $user = auth()->user();
        $prestations = TblPrestation::where('saisiepar', $user->membre->idmembre)->with('docPrestation')->orderBy('created_at', 'desc')->get();
        return view('prestations.mesPrestations', compact('prestations'));
    }

    // Récupère les prestations en fonction du contrat sélectionné
    public function getPrestations(Request $request)
    {
        $idcontrat = $request->input('idcontratPrest');

        try {
            $prestations = TblPrestation::where('idcontrat', $idcontrat)->with('docPrestation')->get();
            if ($prestations->isEmpty()) {
                return response()->json(['status' => 'success', 'data' => []]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $prestations,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue : ' . $th->getMessage(),
            ], 500);
        }
    }
    public function show(string $code)
    {
        $prestation = TblPrestation::where('code', $code)->first();
        return view('prestations.show', compact('prestation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
