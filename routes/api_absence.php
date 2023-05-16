<?php

use App\Http\Controllers\AbsenceController;
use Illuminate\Support\Facades\Route;

Route::post('/absences', [AbsenceController::class, 'store']);
Route::get('/absences/cancel/{id}', [AbsenceController::class, 'cancel']);
Route::get('/absences', [AbsenceController::class, 'show']);

