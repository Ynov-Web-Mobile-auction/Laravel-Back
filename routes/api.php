<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', [AuthController::Class, 'register']);
    Route::post('login', [AuthController::Class, 'login'])->name('login');
    Route::post('logout', [AuthController::Class, 'logout']);
    Route::post('refresh', [AuthController::Class, 'refresh']);
    Route::get('me', [AuthController::Class, 'me']);

});

Route::group([

    'middleware' => 'jwt.auth',

], function ($router) {
    Route::get('users', [UserController::Class, 'index']);
    Route::get('users/{user}', [UserController::Class, 'show']);
    Route::put('users', [UserController::Class, 'update']);

    Route::get('users/{user}/items', [UserController::Class, 'getItemsByUser']);

    Route::get('items', [ItemController::Class, 'index']);
    Route::post('items', [ItemController::Class, 'store']);
    Route::get('items/{item}', [ItemController::Class, 'show']);
    Route::put('items/{item}', [ItemController::Class, 'update']);
});
