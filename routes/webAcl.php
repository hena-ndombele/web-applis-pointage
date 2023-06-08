<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\AgentController;


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



