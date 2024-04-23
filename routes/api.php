<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/update/{id}', [UserController::class, 'update']);
        Route::post('/tambah', [UserController::class, 'store']);
        Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    });
});


Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);


