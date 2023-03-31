<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/logout', [AuthController::class, 'logout']);

Route::middleware(['api', 'auth:api'])->group(function () {
    Route::get('users/me', [UserController::class, 'getMe']);

    Route::apiResource('concerts', ConcertController::class);
    Route::group(['prefix' => 'clubs'], function() {
        Route::get('search', [ClubController::class, 'searchByName'])->name('clubs.search');
        Route::get('', [ClubController::class, 'index']);
        Route::post('', [ClubController::class, 'store']);
        Route::get('{id}', [ClubController::class, 'show'])->name('clubs.show');
        Route::put('{id}', [ClubController::class, 'update']);
        Route::delete('{id}', [ClubController::class, 'destroy']);
    });
    
});
