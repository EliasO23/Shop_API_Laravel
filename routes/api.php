<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Models\Orders;
use App\Models\Users;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('users', [UsersController::class, 'getAllUsers']);
Route::post('register', [UsersController::class, 'register']);
Route::post('login', [UsersController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [UsersController::class, 'logout']);

    Route::group(['prefix' => '/orders'], function () {

        Route::get('/', [OrdersController::class, 'index']);
        Route::post('create', [OrdersController::class, 'store']);
        Route::get('details', [OrdersController::class, 'ordersWithUserDetails']);
        Route::get('user/{id}', [OrdersController::class, 'showOrdersById']);
        Route::get('range', [OrdersController::class, 'ordersInRange']);
        Route::get('users/letter', [UsersController::class, 'getUsersByLetter']);
        Route::get('user/{id}', [OrdersController::class, 'totalOrdersById']);
        Route::get('details/desending', [OrdersController::class, 'ordersDetailsDesending']);
        Route::get('details/economicOrder', [OrdersController::class, 'economicOrder']);
        Route::get('totalSum', [OrdersController::class, 'totalSum']);
        Route::get('details/allOrders', [OrdersController::class, 'ordersOfUsers']);
    });
});
