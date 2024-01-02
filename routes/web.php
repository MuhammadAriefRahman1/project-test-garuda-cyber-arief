<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/transaction', [TransactionController::class, 'checkout'])->name('transaction.checkout');
Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
