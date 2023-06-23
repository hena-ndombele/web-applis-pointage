<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TauxConfigurationController;

Route::resource('taux', TauxConfigurationController::class)->middleware('auth');