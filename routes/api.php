<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\UserController;
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

Route::post('auth/login', [UserController::class, 'login']);
Route::post('auth/register', [UserController::class, 'register']);

Route::middleware(['api', 'auth.jwt'])->group(function () {
    Route::get('users/me', [UserController::class, 'getMe']);

    Route::prefix('concerts')->group(function () {
        Route::get('', [ConcertController::class, 'index']);
    });

    Route::prefix('clubs')->group(function () {
        Route::post('', [ClubController::class, 'store']);
        Route::get('', [ClubController::class, 'index']);
        Route::get('{id}', [ClubController::class, 'show']);
    });
});
