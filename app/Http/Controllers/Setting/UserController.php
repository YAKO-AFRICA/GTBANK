<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use App\Models\Zone;
use App\Mail\UserMail;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Reseau;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\AgenceByParter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
ini_set('memory_limit', '1024M');

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $membres = Membre::orderby('idmembre', 'desc')->where('typ_membre','!=','3')->where('codepartenaire','CORIS')->get();
        $reseaux = Reseau::where('codepartenaire','CORIS')->get();

        $reseauId = $reseaux->pluck('id');

        
        $zones = Zone::whereIn('codereseau', $reseauId)->get();

        $zoneId = $zones->pluck('id');
       
        $equipes = Equipe::whereIn('codezone', $zoneId)->get();
        // \dd($equipes);
        $partners = Partner::where('code','CORIS')->get();
        
        return view('settings.users.index', compact('membres', 'reseaux', 'zones', 'equipes', 'partners'));
    }

    public function updateColumns(Request $request)
    {
        // Sauvegarde des colonnes dans la session
        $columns = $request->input('columns', []);
        session(['activeColumns' => $columns]);

        return redirect()->back()->with('success', 'Colonnes mises à jour avec succès.');
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

        $id = Membre::max('idmembre') + 2;

        $partner = Partner::where('code', $request->codePart)->first();


        DB::beginTransaction();
        try {
            $membre = Membre::create([
                'idmembre' => $id,
                'codeagent' => $request->codeagent,
                'typ_membre' => 2,
                'codereseau' => $request->codereseau,
                'codepartenaire' => $request->codePart,
                'partenaire' => $partner->designation,
                'codezone' => $request->codezone,
                'codeequipe' => $request->codeequipe,
                'sexe' => $request->sexe,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'datenaissance' => $request->datenaissance,
                'profession' => $request->profession,
                'login' => $request->login,
                'role' => $request->role,
                'pass' => $request->pass,
                'email' => $request->email,
                'cel' => $request->cel,
                'tel' => $request->tel,
            ])->save();

            if($membre){
                $user = User::create([
                    'idmembre' => $id,
                    'email' => $request->email,
                    'login' => $request->login,
                    'password' => bcrypt($request->pass),
                    'codepartenaire' => $request->codePart,
                    'branche' => $request->codebranche
                ]);

                DB::commit();

                $userSend = User::where('idmembre', $id)->first();

                $emailSubject = 'Création de votre compte – Activation requise';

                $mailData = [
                    'title' => 'Cher(e) '.$request->prenom.' '.$request->nom.',',
                    'userSend' => $userSend,
                    'email' => $request->email,

                    'btnText' => 'Modifier votre mot de passe',
                    'btnLink' => \url('/password/reset'),
                ];
                

                Mail::to($request->email)->send(new UserMail($mailData,$emailSubject));
                
            }

            DB::commit();

            if($membre){
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
                'message'=>"Erreur systeme! ". $th->getMessage(),
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // \dd($request->all());
        $partner = Partner::where('code', $request->codePart)->first();

        DB::beginTransaction();
        try {
            $membre = Membre::where('idmembre', $id)->update([
                'codeagent' => $request->codeagent,
                // 'typ_membre' => 2,
                'codereseau' => $request->codereseau,
                'codezone' => $request->codezone,
                'codepartenaire' => $request->codePart,
                'partenaire' => $partner->designation,
                'codeequipe' => $request->codeequipe,
                'sexe' => $request->sexe,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'datenaissance' => $request->datenaissance,
                'profession' => $request->profession,
                'login' => $request->login,
                'role' => $request->role,
                'pass' => $request->pass,
                'email' => $request->email,
                'cel' => $request->cel,
                'tel' => $request->tel,
            ]);

            if($membre){
                $user = User::where('idmembre', $id)->update([
                    'email' => $request->email,
                    'login' => $request->login,
                    'password' => bcrypt($request->pass),
                    'codepartenaire' => $request->codePart,
                    'branche' => $request->codebranche
                ]);
                
            }

            DB::commit();

            if($membre){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Modifié avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur de modification !",
                    'code'=>500,
                ];
                DB::rollBack();
            }
            

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! ".$th(),
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        DB::beginTransaction();
        try {

            $saving= Membre::where(['idmembre'=>$id])->delete();

            $user = User::where(['idmembre'=>$id])->delete();

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


    public function userProfile()
    {
        return view('settings.users.profile.index');
    }
    public function updateProfile(Request $request, string $id)
    {
        // $user = TblUsers::where('idmembre', $id)->get();
        // dd($user);
        DB::beginTransaction();
        try {
            $user = Membre::where('idmembre', $id)->first();
            if($request->file('photo') == null){
                $imageName = Auth::user()->membre->photo;
            }else{
                $photoProfile = $request->file('photo');
                // dd($photoProfile);
                if ($photoProfile) {
                    $imageName = $user->idmembre .'_'.  now()->format('YmdHis'). '.' . $photoProfile->getClientOriginalExtension();
                    $destinationPath = public_path('images/userProfile');
                    $photoProfile->move($destinationPath, $imageName);   
                }
            }
            $user->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'cel' => $request->cel,
                'photo' => $imageName ?? '',           
            ]);
            if ($user) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Modifié avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la modification",
                    'code' => 500,
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

    public function updateMp(Request $request)
    {

        // dd($request->password);

        DB::beginTransaction();
        try {

            if ($request->password) {
                if ($request->password !== $request->confirm_password) {
                    DB::rollback();
                    $dataResponse = [
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Les mots de passe ne correspondent pas",
                        'code' => 400,
                    ];
                    return response()->json($dataResponse);
                }
                else{
                    $mp = auth()->user()->update([
                        'password' => bcrypt($request->password)
                    ]);

                    $id = auth()->user()->idmembre;
                    $membre = Membre::where('idmembre', $id)->firstOrFail();
                    if(!$membre){
                        $membre->update(['pass' => bcrypt($request->password)]);
                    }

                    if ($mp) {
                        // Déconnexion de l'utilisateur
                        auth()->logout();
    
                        $dataResponse = [
                            'type' => 'success',
                            'urlback' => "back",
                            'message' => "Modifié avec succès! Veuillez vous reconnecter avec votre nouveau mot de passe.",
                            'code' => 200,
                        ];
                        DB::commit();
                    } else {
                        DB::rollback();
                        $dataResponse = [
                            'type' => 'error',
                            'urlback' => '',
                            'message' => "Erreur lors de la modification",
                            'code' => 500,
                        ];
                    }
    

                }

            } else {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => 'back',
                    'message' => "Le mot de passe ne doit pas être vide",
                    'code' => 400,
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
}
