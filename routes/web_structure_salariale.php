<?php

use App\Http\Controllers\FicheController;
use Illuminate\Support\Facades\Route;

Route::resource('structure', FicheController::class)->middleware('auth');