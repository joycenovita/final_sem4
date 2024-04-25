<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ChalenggeController;
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
        Route::get('/profile', [UserController::class, 'show']);
        Route::post('/update', [UserController::class, 'update']);
        Route::post('/tambah', [UserController::class, 'store']);
        Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    });


    Route::prefix('journal')->group(function(){
        Route::get('/', [JournalController::class, 'index']);
        Route::post('/add', [JournalController::class, 'addJournal']);
        Route::get('/now', [JournalController::class, 'journal_now']);
        Route::get('/{id}', [JournalController::class, 'show']);
        Route::post('/update/{id}', [JournalController::class, 'updateJournal']);
        Route::delete('/delete/{id}', [JournalController::class, 'destroy']);
    });


    Route::prefix('mood')->group(function(){
        Route::get('/', [MoodController::class, 'index']);
        Route::post('/add', [MoodController::class, 'store']);
        Route::get('/{id}', [MoodController::class, 'show']);
        Route::post('/update/{id}', [MoodController::class, 'update']);
        Route::delete('/delete/{id}', [MoodController::class, 'destroy']);
        Route::get('/today', [MoodController::class, 'mood_today']);
    });

    Route::prefix('resource')->group(function(){
        Route::get('/', [ResourceController::class, 'index']);
        Route::post('/add', [ResourceController::class, 'store']);
        Route::get('/{id}', [ResourceController::class, 'show']);
        Route::post('/update/{id}', [ResourceController::class, 'update']);
        Route::delete('/delete/{id}', [ResourceController::class, 'destroy']);
        Route::get('/today', [ResourceController::class, 'Resource_today']);
    });

    Route::prefix('challenge')->group(function(){
        Route::get('/', [ChalenggeController::class, 'index']);
        Route::post('/add', [ChalenggeController::class, 'store']);
        Route::get('/{id}', [ChalenggeController::class, 'show']);
        Route::post('/update/{id}', [ChalenggeController::class, 'update']);
        Route::delete('/delete/{id}', [ChalenggeController::class, 'destroy']);
        
    });

});


Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);


