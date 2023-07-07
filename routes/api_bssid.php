<?php

use App\Models\Bssid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\JoursFerieController;
use App\Http\Controllers\DemandeCongeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/ 

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/scanArrive',[PresenceController::class, 'store'])->name('scanArrive');
    Route::patch('/scanDepart',[PresenceController::class, 'update'])->name('scanDepart');
    Route::delete('/demandes/cancel/{demande}', [DemandeCongeController::class, 'destroy']);
    Route::put('/demandes/{demande}', [DemandeCongeController::class, 'update']);
    Route::post('/demandes',[DemandeCongeController::class,'store']); 
    Route::get('/approbation', [DemandeCongeController::class, 'approbation']);
    Route::get('/presences', [PresenceController::class, 'indexApi']);
    Route::get('/demandesValide', [DemandeCongeController::class, 'getDemandeConge']);
    Route::get('/absences', [DemandeCongeController::class, 'approbation']);
    Route::get('/absenceDate', [AbsenceController::class, 'getAbsenceByDate']);
});
    Route::get('/conges', [CongeController::class, 'indexApi']);
    Route::get('/feries', [JoursFerieController::class, 'indexApi']);
