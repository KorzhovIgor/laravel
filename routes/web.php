<?php

use App\Http\Controllers\Export\DBExportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('products', ProductController::class);
Route::resource('products.services', ServiceController::class)->except(['index']);

//Import and export csv
Route::get('db-export', [DBExportController::class, 'fileExportToS3'])
    ->name('db-export');

