<?php

use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\AntecedentController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\CliniqueController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DocteurController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EchographieController;
use App\Http\Controllers\EchographieDebutGrossesseController;
use App\Http\Controllers\EchographieDeuxiemeTrimestreController;
use App\Http\Controllers\EchographieDeuxiemeTrimestreGemController;
use App\Http\Controllers\EchographieGynecologiqueController;
use App\Http\Controllers\EchographieMammaireController;
use App\Http\Controllers\EchographieNormaleController;
use App\Http\Controllers\EchographiePelvienneController;
use App\Http\Controllers\EchographiePremierTrimestreController;
use App\Http\Controllers\EchographiePremierTrimestreGemController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FamilleAnalyseController;
use App\Http\Controllers\GestationnelleController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\MotifVisiteController;
use App\Http\Controllers\OperationPatientController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientsPermisController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReglementFactureController;
use App\Http\Controllers\ReglementOperationController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SoinController;
use App\Http\Controllers\SoinsController;
use App\Http\Controllers\SousAnalyseController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\TypeOperationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Tenant\SubscriptionController as TenantSubscriptionController;
use App\Http\Middleware\AccountType;
use App\Models\Antecedent;
use App\Models\Document;
use App\Models\EchographieGynecologique;
use App\Models\EchographieNormale;
use App\Models\EchographiePelvienne;
use App\Models\OperationPatient;
use App\Models\ReglementFacture;
use App\Models\typeOperation;
use App\Http\Controllers\TenantRegistrationController;
use App\Http\Controllers\LocaleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Language Switch Route
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Public Tenant Registration Routes
Route::get('/register/clinic', [TenantRegistrationController::class, 'create'])->name('register.tenant');
Route::post('/register/clinic', [TenantRegistrationController::class, 'store'])->name('register.tenant.store');
Route::get('/register/success', [TenantRegistrationController::class, 'success'])->name('register.tenant.success');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:web',
    'verified',

])->group(function () {
    
    // ═══════════════════════════════════════════════════════════════
    // � Tenant Subscription Management - جميع المستخدمين
    // ═══════════════════════════════════════════════════════════════
    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::get('/', [TenantSubscriptionController::class, 'index'])->name('index');
        Route::get('/plans', [TenantSubscriptionController::class, 'comparePlans'])->name('plans');
        Route::post('/request-change', [TenantSubscriptionController::class, 'requestPlanChange'])->name('request-change');
        Route::get('/invoices', [TenantSubscriptionController::class, 'invoices'])->name('invoices');
        Route::get('/invoice/{subscription}', [TenantSubscriptionController::class, 'downloadInvoice'])->name('invoice.download');
    });
    
    // ═══════════════════════════════════════════════════════════════
    // �📊 Dashboard & Statistics - Admin و Docteur فقط
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin,docteur'])->group(function () {
        Route::get('/dashboard', [DocteurController::class, 'dashboard'])->name('dashboard');
        Route::get('/statistique', [DocteurController::class, 'statistique'])->name('statistique');
        Route::get('/parametrage', [DocteurController::class, 'parametrage'])->name('parametrage');
    });

    // ═══════════════════════════════════════════════════════════════
    // 👥 إدارة المستخدمين والأطباء - Admin فقط
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin'])->group(function () {
        Route::get('/admin', [UserController::class, 'index'])->name('admin');
        Route::resource('users', UserController::class)->middleware(['resource.limit:doctors']);
        Route::resource('employes', UserController::class);
        Route::resource('docteurs', DocteurController::class)->middleware(['resource.limit:doctors']);
        Route::resource('reglages', ConfigurationController::class);
        Route::post('/updateLogo', [ConfigurationController::class, 'updateLogo'])->name('updateLogo');
        Route::post('/export-database', [ConfigurationController::class, 'exportDatabase']);
    });

    // ═══════════════════════════════════════════════════════════════
    // 💰 الصندوق - الجميع
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin,docteur,secretaire'])->group(function () {
        Route::get('/caisse', [DocteurController::class, 'caisse'])->name('caisse');
    });

    // ═══════════════════════════════════════════════════════════════
    // 🏥 المرضى والمواعيد - الجميع
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin,docteur,secretaire'])->group(function () {
        Route::resource('patients', PatientController::class)->middleware(['resource.limit:patients']);
        Route::resource('rendezVous', RendezVousController::class);
        Route::get('/patients/list', [PatientController::class, 'getRefrechList'])->name('patientsList');
        Route::put('/patientsAtt/{patient}/{docteur}/{statutPatient}', [PatientController::class, 'updateActive'])->name('patientsAtt');
        Route::post('/api/updatePatientOrder', [PatientController::class, 'updatePatientOrder']);
        Route::delete('/RendezVous/{rendezVousID}', [RendezVousController::class, 'deleteRendezVous'])->name('deleteRendezVous');
        Route::post('/patientAntecedent', [PatientController::class, 'addPatient'])->name('patient.antecedents');
    });

    // ═══════════════════════════════════════════════════════════════
    // 🩺 الاستشارات والوصفات - Admin و Docteur فقط
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin,docteur'])->group(function () {
        Route::resource('consultations', ConsultationController::class);
        Route::resource('ordonnances', OrdonnanceController::class);
        Route::resource('certificats', CertificatController::class);
        Route::resource('prescriptions', PrescriptionController::class);
        Route::resource('traitements', TraitementController::class);
        Route::post('/patient/consultation', [PatientController::class, 'getOrdonnances'])->name('patient.ordonnances');
        Route::delete('/traitement/{traitementId}/medicament/{medicamentId}', [TraitementController::class, 'deleteLigneTraitement'])->name('deleteLigneTraitement');
        Route::delete('/ordonnances/{ordonnanceId}/medicament/{medicamentId}', [OrdonnanceController::class, 'deleteLigneOrdonnance'])->name('deleteLigneOrdonnance');
        Route::put('/traitement/{traitementId}/medicament/{medicament}', [TraitementController::class, 'updateLigneTraitement'])->name('updateLigneTraitement');
        Route::post('/AntecedentsUpdate', [AntecedentController::class, 'updateAntecedants'])->name('updateAntecedants');
        
        // Echographies
        Route::resource('Echographies', EchographieController::class);
        Route::resource('EchographiePelviennes', EchographiePelvienneController::class);
        Route::resource('EchographieDebutGrossessess', EchographieDebutGrossesseController::class);
        Route::resource('EchographiePremierTrimestres', EchographiePremierTrimestreController::class);
        Route::resource('EchographieDeuxiemeTrimestres', EchographieDeuxiemeTrimestreController::class);
        Route::resource('EchographiePremierTrimestreGems', EchographiePremierTrimestreGemController::class);
        Route::resource('EchographieDeuxiemeTrimestreGems', EchographieDeuxiemeTrimestreGemController::class);
        Route::resource('EchographieMammaires', EchographieMammaireController::class);
        Route::resource('EchographieNormales', EchographieNormaleController::class);
        Route::resource('EchographieGynecologique', EchographieGynecologiqueController::class);
        Route::resource('gestationnelles', GestationnelleController::class);
    });

    // ═══════════════════════════════════════════════════════════════
    // 💳 الفواتير والدفع - Admin و Docteur و Secretaire
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin,docteur,secretaire'])->group(function () {
        Route::resource('factures', FactureController::class);
        Route::resource('paiements', PaiementController::class);
        Route::resource('ReglementFacture', ReglementFactureController::class);
        Route::resource('ReglementOperation', ReglementOperationController::class);
    });

    // ═══════════════════════════════════════════════════════════════
    // 🏥 العمليات والعيادات - Admin و Docteur
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin,docteur'])->group(function () {
        Route::resource('operations', OperationPatientController::class);
        Route::resource('cliniques', CliniqueController::class);
        Route::resource('typeOperations', TypeOperationController::class);
    });

    // ═══════════════════════════════════════════════════════════════
    // 📋 البيانات المرجعية - Admin و Docteur
    // ═══════════════════════════════════════════════════════════════
    Route::middleware(['accountType:admin,docteur'])->group(function () {
        Route::resource('medicaments', MedicamentController::class);
        Route::resource('assurances', AssuranceController::class);
        Route::resource('documents', DocumentController::class)->middleware(['resource.limit:storage']);
        Route::resource('soins', SoinController::class);
        Route::resource('antecedents', AntecedentController::class);
        Route::resource('FamilleAnalyse', FamilleAnalyseController::class);
        Route::resource('Analyse', AnalyseController::class);
        Route::resource('SousAnalyse', SousAnalyseController::class);
        Route::resource('motifvisite', MotifVisiteController::class);
        Route::resource('permis', PatientsPermisController::class);
    });
});
