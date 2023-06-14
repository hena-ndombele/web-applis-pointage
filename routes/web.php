<?php

use App\Http\Controllers\AbsenceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BssidController;
use App\Http\Controllers\PresenceController;
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
Route::resource('bssid', BssidController::class); 
Route::resource('bssid', BssidController::class);
Auth::routes();
Route::resource('absences', AbsenceController::class);


