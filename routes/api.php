<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* Inventaris */

Route::get('/inventaris/{id}', [App\Http\Controllers\InventarisController::class, 'show']);
Route::get('/inventaris/ruang/{id}', [App\Http\Controllers\InventarisController::class, 'showByRuang']);

/* Inventaris Perawatan */
Route::get('/inventaris/perawatan/{id}', [App\Http\Controllers\InventarisPerawatanController::class, 'show']);
Route::get('/inventaris/{id}/perawatan', [App\Http\Controllers\InventarisPerawatanController::class, 'showByInventaris']);
Route::get('/inventaris/ruang/{id}/perawatan', [App\Http\Controllers\InventarisPerawatanController::class, 'showByRuang']);
Route::post('/inventaris/perawatan', [App\Http\Controllers\InventarisPerawatanController::class, 'store']);

/* Inventaris Kalibrasi */
Route::get('/inventaris/{id}/kalibrasi', [App\Http\Controllers\InventarisKalibrasiController::class, 'showByInventaris']);
