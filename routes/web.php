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

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/books', [BookController::class, 'index'])->middleware('auth');

Route::get('/books/create', [BookController::class, 'create'])->middleware('auth');
Route::post('/books', [BookController::class, 'store'])->middleware('auth');

Route::get('/books/{id}', [BookController::class, 'show'])->middleware('auth');

Route::get('/books/{id}/edit', [BookController::class, 'edit'])->middleware('auth');
Route::patch('/books/{id}', [BookController::class, 'update'])->middleware('auth');

Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('auth');

Route::post('/books/batch', [BookController::class, 'destroyAll'])->middleware('auth');