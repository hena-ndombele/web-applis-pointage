<?php
use App\Http\Controllers\AbsenceController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BssidController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\JoursFerieController;
use App\Http\Controllers\StockCongeController;
use App\Http\Controllers\DemandeCongeController;
@include('webAcl.php');
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
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
require('web_bssid.php');
Route::resource('presences', PresenceController::class);
Route::resource('conge',CongeController::class);
Route::resource('feries',JoursFerieController::class);
Route::resource('demandes', DemandeCongeController::class);
Route::resource('stockConges', StockCongeController::class);

Auth::routes();
Route::resource('absences', AbsenceController::class);
Route::get('/show-presences/{date}', [PresenceController::class, 'show'])->name('show_presences');
Route::get('/qrcode', [BssidController::class, 'listeQrCode'])->name('qrcode');
Route::get('printQrCode1/{bssid}', [BssidController::class, 'printQrCode1'])->name('printQrCode1');
Route::get('printQrCode2/{bssid}', [BssidController::class, 'printQrCode2'])->name('printQrCode2');
require('web_taux.php');
require('web_horaires.php');





require('web_paie.php');
require('web_structure_salariale.php');