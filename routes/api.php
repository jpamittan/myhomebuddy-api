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
    RegistrationAPIController,
};
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::prefix('register')->group(function () {
        Route::post('/consumer', [RegistrationAPIController::class, 'consumer'])->name('registration.consumer');
        Route::post('/seller', [RegistrationAPIController::class, 'seller'])->name('registration.seller');
    });
});
