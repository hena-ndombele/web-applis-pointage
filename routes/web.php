<?php
use App\Http\Controllers\AbsenceController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BssidController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\JoursFerieController;
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
Auth::routes();
Route::resource('absences', AbsenceController::class);
Route::get('print/{bssid}', [BssidController::class, 'print'])->name('print');
Route::get('/show-presences/{date}', [PresenceController::class, 'show'])->name('show_presences');
require('web_taux.php');




