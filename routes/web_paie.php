<?php

use App\Http\Controllers\PaieController;
use Illuminate\Support\Facades\Route;

Route::resource('paie', PaieController::class)->middleware('auth');