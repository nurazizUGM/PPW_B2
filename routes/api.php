<?php

use App\Http\Controllers\Api\ApiBukuController;
use App\Http\Controllers\Api\GreetController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/greet', [GreetController::class, 'greet']);

Route::prefix('buku')->name('buku.')->group(function () {
    Route::get('/', [ApiBukuController::class, 'index'])->name('index');
    Route::post('/', [ApiBukuController::class, 'store'])->name('store');
});
