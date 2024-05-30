<?php

use App\Http\Controllers\Api\CarController as ApiCarController;
use App\Http\Controllers\CarController;
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


Route::prefix('cars')->group(function () {
    Route::get('/makes', [ApiCarController::class, 'getMakes']);
    Route::get('/years', [ApiCarController::class, 'getYears']);
    Route::get('/models', [ApiCarController::class, 'getModels']);
    Route::get('/variants', [ApiCarController::class, 'getVariants']);
    Route::get('/price', [ApiCarController::class, 'getPrice']);
    Route::get('/filter', [ApiCarController::class, 'filterByPrice']);
});

