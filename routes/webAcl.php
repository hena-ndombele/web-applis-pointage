<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\AgentController;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)->middleware('checkaccess:User');
Route::resource('roles',RoleController::class)->middleware('checkaccess:Role');
Route::post("roles/modify/{roleId}", [App\Http\Controllers\RoleController::class,'modify'])->name('roles.modify');
Route::resource('presences', PresenceController::class)->middleware('checkaccess:Presence');
Route::resource('bssid', BssidController::class)->middleware('checkaccess:Bssid'); 
Route::resource('absences', AbsenceController::class)->middleware('checkaccess:Absence');
Route::resource('services', ServiceController::class)->middleware('checkaccess:Service');
Route::resource('directions', DirectionController::class)->middleware('checkaccess:Direction');
Route::resource('departements', DepartementController::class)->middleware('checkaccess:Departement');
Route::resource('agents',AgentController::class)->middleware('checkaccess:Direction');
Route::get('byDirection/{id?}', [DepartementController::class,'byDirection'])->name('byDirection');
Route::get('byDepartement/{id?}', [ServiceController::class,'byDepartement'])->name('byDepartement');
Route::get('/test-contact', function () {
    return new App\Mail\Contact([
      'nom' => 'Durand',
      'email' => 'christkuzanuka@gmail.com',
      'message' => 'Je voulais vous dire que votre site est magnifique !'
      ]);
});


