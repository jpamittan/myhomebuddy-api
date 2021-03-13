<?php

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

use App\Http\Controllers\API\{
    AuthController,
    RegistrationAPIController,
};
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::prefix('register')->group(function () {
        Route::post('/consumer', [RegistrationAPIController::class, 'consumer'])->name('registration.consumer');
        Route::post('/seller', [RegistrationAPIController::class, 'seller'])->name('registration.seller');
    });
});

Route::middleware('jwt.verify:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('auth.me');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});