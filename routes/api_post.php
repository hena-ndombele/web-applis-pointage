<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AbsenceController;


Route::get('/envoye', [PostController::class, 'envoyerDonneesAuServeur']);



