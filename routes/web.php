<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Livewire\Clubs;
use App\Livewire\Concerts;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(RedirectIfAuthenticated::class)->group(function() {
    Route::get('login', Login::class)->name('login');
});
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'resendEmail'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('', Dashboard::class)->name('home');
    Route::get('profile', Profile::class)->name('profile');
    Route::get('concerts', Concerts::class)->name('concerts');
    Route::get('concerts/{id}', Concerts::class)->name('concerts.show');
    Route::get('clubs', Clubs::class)->name('clubs');
    Route::get('clubs/{id}', [Clubs::class, 'show'])->name('clubs.show');
});
