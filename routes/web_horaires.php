<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\FonctionController;

Route::resource('horaires', HoraireController::class);
Route::resource('contrats', ContratController::class);
Route::resource('fonctions', FonctionController::class);
Route::resource('grades', GradeController::class);
