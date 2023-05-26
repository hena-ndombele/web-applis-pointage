<?php

use App\Http\Controllers\PresenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BssidController;

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


Route::resource('presences', PresenceController::class);


require('web_bssid.php'); 
Route::resource('presences', PresenceController::class);



Route::resource('bssid', BssidController::class);

Auth::routes();
