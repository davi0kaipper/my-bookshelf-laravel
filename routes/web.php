<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('guest');

Route::post('/teste', [BookController::class, 'destroyAll'])->middleware('auth');

Route::get('/', [BookController::class, 'index'])->middleware('auth');

Route::get('/books/{id}', [BookController::class, 'show'])->middleware('auth');

Route::get('/create', [BookController::class, 'create'])->middleware('auth');
Route::post('/create', [BookController::class, 'store'])->middleware('auth');

Route::get('/edit/{id}', [BookController::class, 'edit'])->middleware('auth');
Route::patch('/edit/{id}', [BookController::class, 'update'])->middleware('auth');

Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('auth');
