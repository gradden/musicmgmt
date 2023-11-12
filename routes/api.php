<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login'])->name('api.login');
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/logout', [AuthController::class, 'logout']);

Route::get('image/{classType}/{uuid}', [FileController::class, 'get'])
    ->middleware('auth')
    ->name('api.image');

Route::get('image/profile-picture', [UserController::class, 'getProfilePicture'])
    ->middleware('auth')
    ->name('api.image');

Route::middleware(['api', 'auth'])->group(function () {
    Route::get('users/me', [UserController::class, 'getMe']);
    Route::get('global-search', [GlobalSearchController::class, 'search']);
    Route::post('users/{id}/photos', [FileController::class, 'uploadUserCoverImage'])->name('user.photoupload');

    Route::group(['prefix' => 'clubs'], function() {
        Route::get('search', [ClubController::class, 'searchByName'])->name('clubs.search');
        Route::get('', [ClubController::class, 'index']);
        Route::post('', [ClubController::class, 'store']);
        Route::get('{id}', [ClubController::class, 'show'])->name('clubs.show');
        Route::put('{id}', [ClubController::class, 'update']);
        Route::delete('{id}', [ClubController::class, 'destroy']);
    });

    Route::group(['prefix' => 'concerts'], function() {
        Route::get('search', [ConcertController::class, 'searchByName'])->name('concerts.search');
        Route::get('user/{userId}', [ConcertController::class, 'indexByUserId'])->name('concerts.indexByUserId');
        Route::get('', [ConcertController::class, 'index']);
        Route::post('', [ConcertController::class, 'store']);
        Route::post('{id}/photos', [FileController::class, 'uploadPhotos']);
        Route::delete('photos/{uuid}', [FileController::class, 'deletePhoto']);
        Route::get('{id}', [ConcertController::class, 'show'])->name('concerts.show');
        Route::put('{id}', [ConcertController::class, 'update']);
        Route::delete('{id}', [ConcertController::class, 'destroy']);
    });
});
