<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ClientController;
// use App\Http\Controllers\InvoiceController;
// use App\Http\Controllers\CurrencyController;
// use App\Http\Controllers\UserController;

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('users', UserController::class);
//     Route::put('users/{user}/password', [UserController::class, 'updatePassword']);
// });


// Route::apiResource('clients', ClientController::class);

// Route::apiResource('invoices', InvoiceController::class);

// Route::apiResource('currencies', CurrencyController::class);

// Route::post('/currencies/update-rates', [CurrencyController::class, 'updateRates']);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\UserController;

// Retirer le middleware 'auth:sanctum' de toutes les routes qui ne nécessitent pas d'authentification
Route::apiResource('clients', ClientController::class);
Route::apiResource('invoices', InvoiceController::class);
Route::apiResource('currencies', CurrencyController::class);

// Route pour mettre à jour les taux de change sans authentification
Route::post('/currencies/update-rates', [CurrencyController::class, 'updateRates']);


?>