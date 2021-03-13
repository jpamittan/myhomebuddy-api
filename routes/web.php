<?php

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

use App\Http\Controllers\{
    ActivateController,
    DebugController,
    DashboardController,
    LoginController,
    TermsController
};
use Illuminate\Support\Facades\Route;

Route::prefix('terms')->group(function () {
    Route::get('/consumers', [TermsController::class, 'consumers'])->name('terms.consumers');
    Route::get('/sellers', [TermsController::class, 'sellers'])->name('terms.sellers');
});
Route::prefix('activate')->group(function () {
    Route::get('/consumer/{user}/{hash}', [ActivateController::class, 'consumer'])->name('activate.consumer');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])->name('auth');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('users')->group(function () {
        Route::get('/', [DashboardController::class, 'users'])->name('dashboard.users');
        Route::get('/consumers', [DashboardController::class, 'consumers'])->name('dashboard.consumers');
        Route::get('/consumer/{user}', [DashboardController::class, 'consumer'])->name('dashboard.consumer.view');
        Route::get('/sellers', [DashboardController::class, 'sellers'])->name('dashboard.sellers');
        Route::get('/seller/{user}', [DashboardController::class, 'seller'])->name('dashboard.seller.view');
    });
    Route::prefix('activate')->group(function () {
        Route::get('/seller/{user}', [ActivateController::class, 'seller'])->name('activate.seller');
    });
    Route::prefix('terms')->group(function () {
        Route::get('/', [TermsController::class, 'index'])->name('terms.index');
        Route::post('/update/{term}', [TermsController::class, 'update'])->name('terms.update');
    });
    Route::prefix('debug')->group(function () {
        Route::get('/', [DebugController::class, 'index'])->name('debug.index');
        Route::prefix('users')->group(function () {
            Route::prefix('clear')->group(function () {
                Route::get('/consumers', [DebugController::class, 'clearConsumers'])->name('debug.clearConsumers');
                Route::get('/sellers', [DebugController::class, 'clearSellers'])->name('debug.clearSellers');
            });
        });
    });
});
