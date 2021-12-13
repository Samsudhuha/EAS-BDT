<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\RaksController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('pinjam')->group(function () {
    Route::get('/', [PinjamController::class, 'index']);
    Route::get('/form', [PinjamController::class, 'form']);
    Route::post('/', [PinjamController::class, 'post']);
    Route::post('/update', [PinjamController::class, 'update']);
    Route::post('/delete', [PinjamController::class, 'delete']);
});

Route::prefix('rak')->group(function () {
    Route::get('/', [RaksController::class, 'index']);
    Route::get('/edit/{id}', [RaksController::class, 'edit']);
    Route::get('/form', [RaksController::class, 'form']);
    Route::post('/', [RaksController::class, 'post']);
    Route::post('/edit', [RaksController::class, 'update']);
    Route::post('/delete', [RaksController::class, 'delete']);
});

Route::prefix('buku')->group(function () {
    Route::get('/', [BooksController::class, 'index']);
    Route::get('/view/{tags}', [BooksController::class, 'filter']);
    Route::get('/edit/{id}', [BooksController::class, 'edit']);
    Route::get('/form', [BooksController::class, 'form']);
    Route::post('/', [BooksController::class, 'post']);
    Route::post('/edit', [BooksController::class, 'update']);
    Route::post('/delete', [BooksController::class, 'delete']);
});