<?php

namespace App\Http\Controllers\Admin;


use App\Models\Pret;
use App\Models\Contrat;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BeneficiairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function storeBenefPartner(request $request)
    {

        DB::beginTransaction();
        try {
            $request->validate([
                'prenomBenefPart' => 'required|string',
                'nomBenefPart' => 'required|string',
                'lieuResidenceBenefPart' => 'required|string',
                'numPhoneBenefPart' => 'required|string',
                'emailBenefPart' => 'required|email',
            ]);

            // Enregistrer les données dans la session pour un enregistrement ultérieur
            $beneficiaryData = [
                'prenom' => $request->input('prenomBenefPart'),
                'nom' => $request->input('nomBenefPart'),
                'lieu_residence' => $request->input('lieuResidenceBenefPart'),
                'telephone' => $request->input('numPhoneBenefPart'),
                'email' => $request->input('emailBenefPart'),
            ];

            // Sauvegarder les données dans la session
            Session::put('beneficiaryData', $beneficiaryData);

            DB::commit();
            
            return response()->json([
                'type' => 'success',
                'urlback' => "",
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

    public function saveToDatabase()
    {
        // Récupérer les données depuis la session
        $beneficiaryData = Session::get('beneficiaryData');
    
        if ($beneficiaryData) {
            // Sauvegarder dans la base de données (assurez-vous d'avoir un modèle pour cela)
            $beneficiary = new Beneficiary();
            $beneficiary->prenom = $beneficiaryData['prenom'];
            $beneficiary->nom = $beneficiaryData['nom'];
            $beneficiary->lieu_residence = $beneficiaryData['lieu_residence'];
            $beneficiary->telephone = $beneficiaryData['telephone'];
            $beneficiary->email = $beneficiaryData['email'];
            $beneficiary->save();
    
            // Optionnel : Supprimer les données de la session après la sauvegarde
            Session::forget('beneficiaryData');
    
            return redirect()->route('beneficiaries.index')->with('success', 'Bénéficiaire enregistré avec succès.');
        }
    
        return redirect()->back()->with('error', 'Aucune donnée à enregistrer.');
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

        // \dd($request->all());

        $contrat = Contrat::where('id', $request->contrat)->first();
        DB::beginTransaction();
        try {
                

                $idBenef = Beneficiaire::max('id') + 1;

                Beneficiaire::create([
                    'id' => $idBenef,
                    'civilite' => $request->civilite,
                    'nom' => $request->nomBenef,
                    'prenom' => $request->prenomBenef,
                    'datenaissance' => $request->datenaissanceBenef,
                    'codecontrat' => $request->contrat,
                    'codeadherent' => $contrat->codeadherent,
                    'lieunaissance' => $request->lieunaissanceBenef,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidenceBenef,
                    'filiation' => $request->lienParente,
                    'mobile' => $request->mobileBenef,
                    'email' => $request->emailBenef,
                    'part' => $request->partBenef,
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->idmembre,
                ])->save();

                DB::commit();
            
                return response()->json([
                    'type' => 'success',
                    'urlback' => "back",
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

    public function addBenefPret(Request $request)

    {

        // \dd($request->all());

        $pret = Pret::where('id', $request->pret_id)->first();
        DB::beginTransaction();
        try {
                

                $idBenef = Beneficiaire::max('id') + 1;

                Beneficiaire::create([
                    'id' => $idBenef,
                    'civilite' => $request->civilite,
                    'nom' => $request->nomBenef,
                    'prenom' => $request->prenomBenef,
                    'datenaissance' => $request->datenaissanceBenef,
                    'codecontrat' => $request->pret_id,
                    'codeadherent' => $pret->codeadherent,
                    'lieunaissance' => $request->lieunaissanceBenef,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidenceBenef,
                    'filiation' => $request->lienParente,
                    'mobile' => $request->mobileBenef,
                    'email' => $request->emailBenef,
                    'part' => $request->partBenef,
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->idmembre,
                ])->save();

                DB::commit();
            
                return response()->json([
                    'type' => 'success',
                    'urlback' => "back",
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());

        DB::beginTransaction();
        try {
                
                Beneficiaire::where('id', $id)->update([
                    'nom' => $request->nomBenef,
                    'prenom' => $request->prenomBenef,
                    'datenaissance' => $request->datenaissanceBenef,
                    'lieunaissance' => $request->lieunaissanceBenef,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidenceBenef,
                    'filiation' => $request->lienParente,
                    'mobile' => $request->mobileBenef,
                    'email' => $request->emailBenef,
                    'part' => $request->partBenef,
                ]);

                DB::commit();
            
                return response()->json([
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Modification effectuée avec succès!",
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

    public function addBenefType(Request $request,string $id)
    {
        DB::beginTransaction();
        try 
        {
            $contrat = Contrat::find($id);
            if ($contrat) {

                $contrat->update([
                    'beneficiaireauterme' => $request->beneficiaireauterme,
                    'beneficiaireaudeces' => $request->beneficiaireaudeces,
                ]);
                
                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Beneficiaire ajouté avec succès!",
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

    public function updateBeneficiaire(Request $request)
    {

        $contrat = Contrat::where('id', $request->contrat_id)->update([
            'beneficiaireauterme' => $request->beneficiaireauterme,
        ]);
            
        return response()->json(['success' => true, 'message' => 'Bénéficiaire mis à jour avec succès']);
    }
    public function updateBenefDeces(Request $request)
    {

        $contrat = Contrat::where('id', $request->contrat_id)->update([
            'beneficiaireaudeces' => $request->beneficiaireaudeces,
        ]);
            
        return response()->json(['success' => true, 'message' => 'Bénéficiaire mis à jour avec succès']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try 
        {
            $beneficiaire = Beneficiaire::find($id);
            if ($beneficiaire) {

                $beneficiaire->delete();

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
