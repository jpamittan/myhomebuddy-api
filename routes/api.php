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
    BillingAccountAPIController,
    OrderAPIController,
    OrderScheduleAPIController,
    ProductAPIController,
    RegistrationAPIController,
    ReviewProductAPIController
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
    Route::prefix('consumer')->group(function () {
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductAPIController::class, 'get'])->name('product.get');
            Route::get('/{product}', [ProductAPIController::class, 'consumerQuery'])->name('product.consumerQuery');
            Route::prefix('review')->group(function () {
                Route::post('/', [ReviewProductAPIController::class, 'create'])->name('reviewproduct.create');
            });
        });
    });
    Route::prefix('seller')->group(function () {
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductAPIController::class, 'fetch'])->name('product.fetch');
            Route::post('/', [ProductAPIController::class, 'create'])->name('product.create');
            Route::get('/{product}', [ProductAPIController::class, 'sellerQuery'])->name('product.sellerQuery');
            Route::put('/{product}', [ProductAPIController::class, 'update'])->name('product.update');
            Route::delete('/{product}', [ProductAPIController::class, 'delete'])->name('product.delete');
        });
    });
    Route::prefix('billing')->group(function () {
        Route::prefix('account')->group(function () {
            Route::get('/', [BillingAccountAPIController::class, 'get'])->name('billingaccount.get');
            Route::post('/', [BillingAccountAPIController::class, 'create'])->name('billingaccount.create');
        });
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderAPIController::class, 'get'])->name('order.get');
        Route::get('/{order}', [OrderAPIController::class, 'query'])->name('order.query');
        Route::post('/', [OrderAPIController::class, 'create'])->name('order.create');
        Route::put('/{order}', [OrderAPIController::class, 'update'])->name('order.update');
        Route::delete('/{order}', [OrderAPIController::class, 'delete'])->name('order.delete');
        Route::prefix('schedule')->group(function () {
            Route::post('/{orderSchedule}', [OrderScheduleAPIController::class, 'update'])->name('orderschedule.update');
        });
    });
});
