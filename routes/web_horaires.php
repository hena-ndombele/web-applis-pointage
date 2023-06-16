<?php

use App\Http\Controllers\ContratController;
use App\Http\Controllers\HoraireController;
use Illuminate\Support\Facades\Route;

Route::resource('horaires', HoraireController::class);
Route::resource('contrats', ContratController::class);
