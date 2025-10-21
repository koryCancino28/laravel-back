<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('vehiculos', [VehiculoController::class, 'index']);
Route::get('vehiculos/{id}', [VehiculoController::class, 'show']);
Route::post('vehiculos', [VehiculoController::class, 'store']);
Route::put('vehiculos/{id}', [VehiculoController::class, 'update']);
Route::delete('vehiculos/{id}', [VehiculoController::class, 'destroy']);
