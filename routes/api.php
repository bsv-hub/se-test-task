<?php

use App\Http\Controllers\PriceController;
// use Illuminate\Http\Request;
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

// TODO: возможно использовать ресурсный раутинг
Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');
Route::patch('/prices/{product}', [PriceController::class, 'update'])->name('prices.update');
