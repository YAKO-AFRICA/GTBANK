<?php

namespace App\Http\Controllers\Admin;


use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

use App\Models\Contrat;


use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BulletinController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ini_set('memory_limit', '1024M');

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contrat = Contrat::find($id);
        return view('productions.components.bullettin.basicBulletin', compact('contrat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function generate(request $request, $id)
    {
        DB::beginTransaction();
        try {
            $contrat = Contrat::find($id);
            if($contrat)
            {
                // Options pour Dompdf
                $options = new Options();
                $options->set('isRemoteEnabled', true);
            
                // Générer le bulletin PDF avec Dompdf
                $pdf = Pdf::loadView('productions.components.bullettin.securCompt', [
                    'contrat' => $contrat
                ]);
            
                // Répertoire pour enregistrer les fichiers temporaires
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }
            
                $bulletinFileName = $bulletinDir . 'temp_bulletin_' . $contrat->id . '.pdf';
                $pdf->save($bulletinFileName);
            
                // Chemin vers le fichier CGU
                // $cguFile = public_path('root/cgu/CGPLanggnant.pdf');
                $cguFile = public_path('root/cgu/CguCMF.pdf');
            
                // Fusionner les PDF avec FPDI
                $finalPdf = new Fpdi();
            
                // Ajouter les pages du bulletin
                $finalPdf->AddPage();
                $finalPdf->setSourceFile($bulletinFileName);
                $tplIdx = $finalPdf->importPage(1);
                $finalPdf->useTemplate($tplIdx);
            
                // Ajouter toutes les pages du fichier CGU
                $pageCount = $finalPdf->setSourceFile($cguFile);
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $tplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($tplIdx);
                }
            
                // Nom final du fichier
                $finalFileName = $bulletinDir . 'basic_bulletin_' . $contrat->id . '.pdf';
            
                // Enregistrer le PDF final
                $finalPdf->Output($finalFileName, 'F');
            
                // Supprimer le fichier temporaire du bulletin
                unlink($bulletinFileName);

                DB::commit();
            
                // Retourner le PDF final en tant que réponse
                return response()->file($finalFileName, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($finalFileName) . '"'
                ]);

                
            }else{
                DB::rollBack();
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la generation du bullettin! $th",
                    'code' => 500,
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

    public function generateBulletinSecuriCompt($id)
    {
        ini_set('memory_limit', '1024M');

        $racine = "8301100011116";

        // Trouver le dernier bulletin pour incrémenter
        $dernierBulletin = Contrat::where('codeproduit', "SECURICPTE")->orderBy('numBullettin', 'desc')->first();
        $numGenerer = $dernierBulletin ? ((int)substr($dernierBulletin->numBullettin, strlen($racine))) + 1 : 1;

        // Construire le numéro de bulletin unique
        $numeroBulletin = $racine . $numGenerer;

        // dd($numeroBulletin);

        try {
            // Récupérer les données nécessaires au bulletin
            $contrat = Contrat::findOrFail($id);

            // Options pour DomPDF
            $options = new Options();
            $options->set('isRemoteEnabled', true);

            // Génération du bulletin PDF temporaire
            $pdf = PDF::loadView('productions.components.bullettin.securCompt', [
                'contrat' => $contrat,
                'numeroBulletin' => $numeroBulletin,
            
            ])->setPaper('a4', 'portrait')
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
            $finalBulletinPath = $bulletinDir . 'securi_compt' . $contrat->id . '.pdf';
            $finalPdf->Output($finalBulletinPath, 'F');

            // Supprimer le fichier temporaire du bulletin
            unlink($tempBulletinPath);

            // Définir l'URL publique pour le fichier final
            $fileUrl = asset("documents/bulletin/securi_compt{$contrat->id}.pdf");

            return response()->file($finalBulletinPath, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($finalBulletinPath) . '"'
                ]);

        } catch (\Exception $e) {
            Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
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
