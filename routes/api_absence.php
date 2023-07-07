<?php

use App\Http\Controllers\AbsenceController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/absences', [AbsenceController::class, 'store']);
    Route::get('/absences', [AbsenceController::class, 'show']);
    Route::post('/absences/cancel', [AbsenceController::class, 'cancel']);
    Route::get('/absences/{user_id}', [AbsenceController::class, 'findForUser']);
});


