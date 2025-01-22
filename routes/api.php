<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;

/**
 * Get the authenticated User
 */
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/**
 * Routes for get all users, login, and register
 */
Route::get('users', [UsersController::class, 'getAllUsers']);
Route::post('register', [UsersController::class, 'register']);
Route::post('login', [UsersController::class, 'login']);

/**
 * Routes for orders with middleware auth:sanctum
 */
Route::middleware('auth:sanctum')->group(function () {

    //Route for logout users
    Route::post('logout', [UsersController::class, 'logout']);

    Route::group(['prefix' => '/orders'], function () {

        //Route for get all orders
        Route::get('/', [OrdersController::class, 'index']);

        //Route for create new order
        Route::post('create', [OrdersController::class, 'store']);

        //Route for get orders by user id "2"
        Route::get('user/{id}', [OrdersController::class, 'showOrdersById']);

        //Route for get orders with user details
        Route::get('details', [OrdersController::class, 'ordersWithUserDetails']);

        //Route for get orders on range between 100 and 250
        Route::get('range', [OrdersController::class, 'ordersInRange']);

        //Route for get users with start letter "R"
        Route::get('users/letter', [UsersController::class, 'getUsersByLetter']);

        //Route for get total orders by user id "5"
        Route::get('totalorders/user/{id}', [OrdersController::class, 'totalOrdersById']);

        //Route for get orders details in ascending order
        Route::get('details/desending', [OrdersController::class, 'ordersDetailsDesending']);

        //Route for get total sum of orders table
        Route::get('totalSum', [OrdersController::class, 'totalSum']);

        //Route for get economic order
        Route::get('details/economicOrder', [OrdersController::class, 'economicOrder']);

        //Route for get all orders for users
        Route::get('details/allOrders', [OrdersController::class, 'ordersOfUsers']);
    });
});
