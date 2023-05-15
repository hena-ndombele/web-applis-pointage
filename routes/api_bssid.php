<?php

use App\Models\Bssid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/ 

Route::post('/scan', function (Request $request) {
    $validatedData = $request->validate([
        'bssid' => 'required|string',
        'user_id' => 'required|integer',
    ]);

    if (Bssid::where('bssid', $validatedData['bssid'])->exists()) {
        return response()->json(['message' => 'Succes'], 200);
    }
    else{
        return response()->json(['message' => 'fail'], 403);
    }
});

