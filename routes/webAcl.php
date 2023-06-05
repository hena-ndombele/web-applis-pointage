<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)->middleware('checkaccess:User');
Route::resource('roles',RoleController::class)->middleware('checkaccess:Role');
Route::post("roles/modify/{roleId}", [App\Http\Controllers\RoleController::class,'modify'])->name('roles.modify');