<?php

use App\Http\Controllers\ApiBookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/books', [ApiBookController::class, 'index'])->middleware('token');
Route::get('/books/{id}', [ApiBookController::class, 'show'])->middleware('token');
Route::post('/books', [ApiBookController::class, 'store'])->middleware('token');
Route::put('/books/{id}', [ApiBookController::class, 'update'])->middleware('token');
Route::delete('/books/{id}', [ApiBookController::class, 'destroy'])->middleware('token');
