<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;

// Route::apiResource('vehiculos/', VehiculoController::class); //con eso busca pero malogra lo demas
Route::get('/vehiculos/buscar', [VehiculoController::class, 'buscar']);
Route::apiResource('vehiculos', VehiculoController::class); 
