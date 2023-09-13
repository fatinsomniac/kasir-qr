<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Route::get('/', [OrderController::class, 'index'])->name('order.index');
Route::post('/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/store/reset', [OrderController::class, 'reset'])->name('order.reset');
Route::get('/store/invoice', [OrderController::class, 'print'])->name('order.print');
