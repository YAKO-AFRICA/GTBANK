<?php

namespace App\Http\Controllers\Admin;

use App\Models\Zone;
use App\Models\Equipe;
use App\Models\Reseau;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ReseauProduct;
use App\Models\AgenceByParter;
use App\Models\ProductFormule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function productByReseau()
    {

        $reseaux = Reseau::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        $formules = ProductFormule::all();
        return view('admin.settings.productByReseau', compact('reseaux', 'products', 'formules'));
    }

    public function getFormulesByProduct($codeProduit)
    {
        $formules = ProductFormule::where('CodeProduit', $codeProduit)->get();
        return response()->json($formules);
    }

    public function productByReseauStore(Request $request)
    {
        // \dd($request->all());

        DB::beginTransaction();
        try {

            $libelle = ProductFormule::select('MonLibelle')->where('CodeProduit', $request->codeproduit)->first();
            $equipe = ReseauProduct::create([
                'codereseau' => $request->codereseau,
                'codeproduit' => $request->codeproduit,
                'codeproduitformule' => $request->codeproduitformule,
                'libelleproduit' => $libelle->MonLibelle,
                'estactif' => "1",
            ])->save();

            DB::commit();

            if($equipe){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur d'enregistrement !",
                    'code'=>500,
                ];
                DB::rollBack();
            }
        
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! ".$th->getMessage(),
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function agenceByReseau(request $request)
    {
        // \dd($request->all());

        DB::beginTransaction();
        try {

            $agencesPartner = AgenceByParter::create([
                'codeAgnce' => Refgenerate(AgenceByParter::class, 'AG', 'codeAgnce'),
                'libelle' => $request->libelle,
                'codeBanque' => $request->codeBanque,
                'codePartner' => $request->codePartner,
            ]);

            if($agencesPartner){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur d'enregistrement !",
                    'code'=>500,
                ];
                DB::rollBack();
            }

         
        
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! ".$th->getMessage(),
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function getAgenceByPartner()
    {
        $codePartner = Auth()->user()->membre->codepartenaire;
        $agencesByPartner = AgenceByParter::where('codePartner', $codePartner)->get();

        return view('settings.agences.index', compact('agencesByPartner'));
    }

    public function destroyAgence($id)
    {

        DB::beginTransaction();
        try {

            $deletted= AgenceByParter::where(['id'=>$id])->delete();

            if ($deletted) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Supprimé avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la suppression!",
                    'code'=>500,
                ];
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }
    public function destroy($id)
    {

        DB::beginTransaction();
        try {

            $saving= ReseauProduct::where(['id'=>$id])->delete();

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Supprimé avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la suppression!",
                    'code'=>500,
                ];
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }



    public function getZones($codereseau)
    {
        $zones = Zone::where('codereseau', $codereseau)->get();
        return response()->json($zones);
    }

    // Récupérer les équipes en fonction de la zone sélectionnée
    public function getEquipes($codezone)
    {
        $equipes = Equipe::where('codezone', $codezone)->get();
        return response()->json($equipes);
    }

}
