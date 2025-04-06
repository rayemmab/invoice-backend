<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\UserController;


Route::post('/currencies/update-rates', [CurrencyController::class, 'updateRates']);

Route::apiResources([
    'clients'=> ClientController::class,
    'invoices'=> InvoiceController::class,
    'currencies'=> CurrencyController::class,
    'users'=> UserController::class,
]);
