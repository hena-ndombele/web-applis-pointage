<?php

use App\Http\Controllers\PresenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BssidController;
use Illuminate\Support\Facades\Auth;
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


routes/web.php

Route::resource('presences', PresenceController::class);


require('web_bssid.php'); 

Route::resource('presences', PresenceController::class);



 routes/web.php
Route::resource('bssid', BssidController::class); 

Route::resource('bssid', BssidController::class);
 routes/web.php

Auth::routes();
