<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DocumentController;



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

require('api_bssid.php'); 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('utilisateur', [DocumentController::class, 'utilisateur']);
Route::get('auth/recuperer', [AuthController::class, 'recu']);

require 'api_login.php';
require('api_absence.php'); 
require 'api_logout.php';
require 'api_profil.php';
require 'api_register.php';


require 'api_informationAgent.php';
require 'api_approbation.php';
require 'api_change-password.php';
require 'api_passwordReset.php';
require 'api_recuAbsence.php';
require 'api_recuperer.php';












