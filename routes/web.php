<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RdvController;
use App\Http\Controllers\Admin\EpretController;
use App\Http\Controllers\Setting\UserController;
use App\Http\Controllers\Setting\ZoneController;
use App\Http\Controllers\Admin\AssurerController;
use App\Http\Controllers\Admin\RapportController;
use App\Http\Controllers\Admin\AdherentController;
use App\Http\Controllers\Admin\BulletinController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Setting\EquipCcontroller;
use App\Http\Controllers\Setting\EquipeController;
use App\Http\Controllers\Setting\PartnerController;
use App\Http\Controllers\Setting\ReseauxController;
use App\Http\Controllers\Admin\PrestationController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\BeneficiairesController;
use App\Http\Controllers\Admin\RenouvellementController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// api


Route::post('/save-beneficiary-session', [EpretController::class, 'saveBeneficiarySession']);
// web.php

Route::post('/beneficiaires/temp-store', function (Request $request) {
    $beneficiaire = $request->all();

    // Récupérer les bénéficiaires existants en session
    $beneficiaires = Session::get('beneficiaires', []);

    // Ajouter le nouveau bénéficiaire à la liste
    $beneficiaires[] = $beneficiaire;

    // Sauvegarder dans la session
    Session::put('beneficiairesPret', $beneficiaires);

    Log::info('Bénéficiaire ajouté temporairement'. json_encode($beneficiaires));

    return response()->json(['message' => 'Bénéficiaire ajouté temporairement', 'beneficiaires' => $beneficiaires]);
});

Route::post('/save-beneficiary-partner', [BeneficiairesController::class, 'storeBenefPartner'])->name('storeBenefPartner');

Route::get('storage/documents/{file}', function ($file) {
    // $path = base_path('../uploads/prestations/' . $file);
    $path = base_path(env('UPLOADS_PATH') . $file);

    if (!file_exists($path)) {
        abort(404);
    }

    $fileContents = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($fileContents, 200, ['Content-Type' => $mimeType]);
    
})->where('file', '.*');

Route::post('/notifications/mark-all-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAllAsRead');


Route::middleware('guest','PreventBackHistory')->group(function(){

    Route::get('/', function () {
        return view('auth.login');
    });
    

});




route::get('/generate-bulletin-demo', [EpretController::class, 'generateBu'])->name('generateBul');

Auth::routes();
Route::get('/formules/{codeProduit}', [SettingsController::class, 'getFormulesByProduct']);


Route::prefix('shared')->name('shared.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

        // formule by product reseau 

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::post('/update/assuree/{id}', [AssurerController::class, 'updateAssur'])->name('assuree.update');
    });

});


Route::get('prestation/getInfoPrestation/{id}', [PrestationController::class, 'getInfoPrestation'])->name('getInfoPrestation');
Route::prefix('prestation')->name('prestation.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        // customer prestation routes
        Route::get('/index',[PrestationController::class, 'index'])->name('index');
        Route::post('/fetch-Customer-details', [PrestationController::class, 'fetchCustomerDetails'])->name('fetchCustomerDetails');
        Route::get('/selectPrestation',[PrestationController::class, 'selectPrestation'])->name('selectPrestation');
        Route::get('/mesPrestations', [PrestationController::class, 'mesPrestations'])->name('mesPrestations');
        Route::get('/print-fiche-prestation', [PrestationController::class, 'printFichePrestation'])->name('printFichePrestation');
        
        // Route::post('prestation/getPrestations', [DemandePrestationController::class, 'getPrestations'])->name('getPrestations');
        // Route::get('prestation/mesPrestations', [PrestationController::class, 'mesPrestations'])->name('mesPrestations');
        Route::get('/create/{id}',[PrestationController::class, 'create'])->name('create');
        Route::get('show/{code}',[PrestationController::class, 'show'])->name('show');
        Route::post('/add',[PrestationController::class, 'store'])->name('store');
        // Route::post('prestation/update/{uuid}',[CustomerPrestationController::class, 'update'])->name('prestation.update');
        // Route::post('prestation/destroy/{uuid}',[CustomerPrestationController::class, 'destroy'])->name('prestation.destroy');
        
    });

});


Route::prefix('rdv')->name('rdv.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('index',[RdvController::class, 'index'])->name('index');
        Route::get('/create/{id}',[RdvController::class, 'create'])->name('create');
        Route::get('/optionDate/{id}', [RdvController::class, 'getOptionRdv'])->name('optionDate');
        // Route::get('rdv/getRdvDate/{id}/{dateRdv}',[RdvController::class, 'getOptionRdv'])->name('rdv.optionDate');
        // Route::get('rdv/getRdvDate/{id}/{dateRdv}',[RdvController::class, 'getOptionRdv'])->name('rdv.optionDate');
        Route::get('/getRdv', [RdvController::class, 'getRdvByDate'])->name('getRdv');
        Route::post('/add',[RdvController::class, 'store'])->name('store');
    });

});
Route::prefix('report')->name('report.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('eSouscription',[RapportController::class, 'eSouscription'])->name('eSouscription');
        Route::get('ePret',[RapportController::class, 'ePret'])->name('ePret');
    });

});



Route::prefix('settings')->name('setting.')->group(function(){

    Route::middleware('guest','PreventBackHistory')->group(function(){


    });

    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/index-reseaux', [ReseauxController::class, 'index'])->name('reseau.index');
        Route::post('/store-reseaux', [ReseauxController::class, 'store'])->name('reseau.store');
        Route::post('/update-reseaux/{id}', [ReseauxController::class, 'update'])->name('reseau.update');
        Route::post('/destroy-reseaux/{id}', [ReseauxController::class, 'destroy'])->name('destroy.reseau');

        // Zone 
        Route::get('/index-zones', [ZoneController::class, 'index'])->name('zone.index');
        Route::post('/store-zones', [ZoneController::class, 'store'])->name('zone.store');
        Route::post('/update-zones/{id}', [ZoneController::class, 'update'])->name('zone.update');
        Route::post('/destroy-zones/{id}', [ZoneController::class, 'destroy'])->name('destroy.zone');

        // equipe 
        Route::get('/index-equipe', [EquipeController::class, 'index'])->name('equipe.index');
        Route::post('/store-equipe', [EquipeController::class, 'store'])->name('equipe.store');
        Route::post('/update-equipe/{id}', [EquipeController::class, 'update'])->name('equipe.update');
        Route::post('/destroy-equipe/{id}', [EquipeController::class, 'destroy'])->name('destroy.equipe');

        // utilisateur
        Route::get('/index-users', [UserController::class, 'index'])->name('user.index');
        Route::post('/store-users', [UserController::class, 'store'])->name('user.store');
        Route::post('/update-users/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('/destroy-users/{id}', [UserController::class, 'destroy'])->name('destroy.user');

        Route::post('/update-columns', [UserController::class, 'updateColumns'])->name('updateColumns');


        Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
        Route::post('/user/profile/update/{idmembre}', [UserController::class, 'updateProfile'])->name('user.profile.update');
        Route::post('/user/profile/updatePwd/', [UserController::class, 'updateMp'])->name('user.profile.updatePwd');


        // partenaires
        Route::get('/index-partners', [PartnerController::class, 'index'])->name('partner.index');
        Route::post('/store-partners', [PartnerController::class, 'store'])->name('partner.store');
        Route::post('/destroy-partners/{id}', [PartnerController::class, 'destroy'])->name('destroy.partner');
        Route::post('/update-partners/{id}', [PartnerController::class, 'update'])->name('partner.update');
        Route::post('/update-columns-partners', [PartnerController::class, 'updateColumnsPart'])->name('updateColumnsPart');

        //store reseau by product
        Route::post('/store-product-by-reseau', [SettingsController::class, 'productByReseauStore'])->name('store.product.by.reseau');
        Route::post('/destroy-product-by-reseau/{id}', [SettingsController::class, 'destroy'])->name('destroy.productReseau');

        // agence pour les partenaires

        Route::post('/store-agenceByReseau', [SettingsController::class, 'agenceByReseau'])->name('store.agenceByReseau');
        Route::get('/get-agenceByReseau', [SettingsController::class, 'getAgenceByPartner'])->name('get.agenceByReseau');
        Route::post('/delete-destroyAgence/{id}', [SettingsController::class, 'destroyAgence'])->name('destroyAgence');

        



    });

});

Route::prefix('epret')->name('epret.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

        // formule by product reseau

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/demoSimulateur', [EpretController::class, 'demoSimulateur'])->name('demoSimulateur');
        Route::get('/index', [EpretController::class, 'index'])->name('index');
        Route::get('/simulateur', [EpretController::class, 'simulateur'])->name('simulateur');

        Route::post('/store-simulation', [EpretController::class, 'storeSimulation'])->name('storeSimulation');
        
        Route::get('/create', [EpretController::class, 'create'])->name('create');
        Route::post('/store', [EpretController::class, 'store'])->name('store');
        Route::get('/show/{id}', [EpretController::class, 'show'])->name('show');
        Route::post('/addDocDefaud', [EpretController::class, 'addDocDefaud'])->name('addDocDefaud');
        Route::get('/generateBu', [EpretController::class, 'generateBu'])->name('generateBu');
        Route::get('/printLoanBia/{idPret}', [EpretController::class, 'printLoanBia'])->name('printLoanBia');
        Route::get('/edit/{id}', [EpretController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [EpretController::class, 'update'])->name('update');
        Route::post('/trans-pret/{id}', [EpretController::class, 'transmettrePret'])->name('transmettrePret');
        Route::post('/destroy/{id}', [EpretController::class, 'destroy'])->name('destroy');

        Route::post('/update/adherent/{id}', [AdherentController::class, 'update'])->name('adherent.update');
        Route::post('/store/benef', [BeneficiairesController::class, 'addBenefPret'])->name('addBenefPret');
        Route::get('/print/qm', [DocumentController::class, 'QmedicalPrint'])->name('QmedicalPrint');
        
    });

});

Route::prefix('production')->name('prod.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

        // formule by product reseau 

    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/index', [ProductionController::class, 'index'])->name('index');
        Route::get('/show/{id}', [ProductionController::class, 'show'])->name('show');
        Route::post('/transmettreContrat/{id}', [ProductionController::class, 'transmettreContrat'])->name('transmettreContrat');
        Route::get('/edit/{id}', [ProductionController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductionController::class, 'update'])->name('contrat.update');
        Route::get('/create/stepProduct', [ProductionController::class, 'stepProduct'])->name('stepProduct');
        Route::get('/create/add/{codeproduit}', [ProductionController::class, 'create'])->name('create');
        Route::post('/store', [ProductionController::class, 'store'])->name('store');
        Route::post('/upload-documents', [ProductionController::class, 'upload'])->name('upload.documents');

        Route::get('production/assureadd/get', [ProductionController::class, 'addassurgetForm'])->name('production.get.assureadd');
        Route::post('/add-assure-session', [ProductionController::class, 'addAssureToSession'])->name('addAssureToSession');
        Route::get('/get-assures-session', [ProductionController::class, 'getAssuresFromSession'])->name('getAssuresFromSession');

        Route::post('/update/adherent/{id}', [AdherentController::class, 'update'])->name('adherent.update');

        Route::post('/store/assure', [AssurerController::class, 'store'])->name('store.assurer');
        Route::post('/assures/update/{id}', [AssurerController::class, 'update'])->name('assures.update');
        Route::post('/deleteassure/{id}', [AssurerController::class, 'deleteAssure'])->name('delete.assure');

        Route::post('/store/benef', [BeneficiairesController::class, 'store'])->name('store.beneficiaires');
        Route::post('/update/benef/{id}', [BeneficiairesController::class, 'update'])->name('update.beneficiaires');
        
        Route::post('/beneficiaires/addBenefType{id}', [BeneficiairesController::class, 'addBenefType'])->name('addBenefType');

        Route::post('/update/benefire/{id}', [BeneficiairesController::class, 'updateBeneficiaire'])->name('benef.update');
        Route::post('/update/benefDeces/{id}', [BeneficiairesController::class, 'updateBenefDeces'])->name('benef.deces.update');

        Route::post('/delete/beneficiaire/{id}', [BeneficiairesController::class, 'destroy'])->name('delete.beneficiaire');
        
        Route::post('/store/document', [DocumentController::class, 'store'])->name('store.document');
        Route::post('/store/document/pret', [DocumentController::class, 'storeDocPret'])->name('storeDocPret');
        Route::post('/destroy/document/{id}', [DocumentController::class, 'destroy'])->name('destroy.document');


        // bulletin

        Route::get('/show/bullettin/{id}', [BulletinController::class, 'show'])->name('bullettin.show');
        // Route::get('/generate-bulletin/{id}', [BulletinController::class, 'generate'])->name('generate.bulletin');
        Route::get('/generate-bulletin/{id}', [BulletinController::class, 'generateBulletinSecuriCompt'])->name('generate.securi.bulletin');
        


    });

});

Route::prefix('renouvellement')->name('renov.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

        // formule by product reseau 

    });
    Route::middleware(['auth'])->group(function () {
        
        Route::get('/index', [RenouvellementController::class, 'index'])->name('index');


    });

});




