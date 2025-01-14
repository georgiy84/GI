<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group that
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Ruta protegida con autenticación Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de API para cada controlador

Route::apiResource('businesses', BusinessController::class);      // CRUD para Empresas
Route::apiResource('categories', CategoryController::class);      // CRUD para Categorías
Route::apiResource('products', ProductController::class);         // CRUD para Productos
Route::apiResource('inventory-logs', InventoryLogController::class); // CRUD para Movimientos de Inventario
Route::apiResource('alerts', AlertController::class);             // CRUD para Alertas
Route::apiResource('settings', SettingController::class);         // CRUD para Configuraciones
