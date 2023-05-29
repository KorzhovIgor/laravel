<?php

use App\Http\Controllers\CurrencyExchangeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CurrencyExchangeController::class, 'getCurrencyCourses'])->name('currency');
