<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\ApiAuthenticatedSessionController;
use Illuminate\Session\Middleware\StartSession;

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

// Ruta pública para login con sesión
Route::post('/login', [ApiAuthenticatedSessionController::class, 'store'])
    ->middleware([StartSession::class]);

// Ruta para obtener información del usuario autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Grupo de rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // CRUD para Empresas
    Route::apiResource('businesses', BusinessController::class);

    // CRUD para Categorías
    Route::apiResource('categories', CategoryController::class);

    // CRUD para Productos
    Route::apiResource('products', ProductController::class);

    // CRUD para Movimientos de Inventario
    Route::apiResource('inventory-logs', InventoryLogController::class);

    // CRUD para Alertas
    Route::apiResource('alerts', AlertController::class);

    // CRUD para Configuraciones
    Route::apiResource('settings', SettingController::class);
});
