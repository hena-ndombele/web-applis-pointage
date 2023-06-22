<?php

use App\Http\Controllers\PaieController;
use Illuminate\Support\Facades\Route;

Route::resource('paie', PaieController::class)->middleware('auth');
Route::get('paie/pdf/{status}', [PaieController::class, 'generate_pdf'])->name('paie.pdf')->middleware('auth');