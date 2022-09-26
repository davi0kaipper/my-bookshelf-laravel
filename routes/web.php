<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::get('/', [BookController::class, 'index']);

Route::get('/books/{id}', [BookController::class, 'show']);

Route::get('/create', [BookController::class, 'create']);
Route::post('/create', [BookController::class, 'store']);

Route::get('/edit/{id}', [BookController::class, 'edit']);
Route::patch('/edit/{id}', [BookController::class, 'update']);
