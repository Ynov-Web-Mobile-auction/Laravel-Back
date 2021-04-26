<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
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
    Route::put('me', [AuthController::Class, 'update']);

});

Route::group([

    'middleware' => 'jwt.auth',

], function ($router) {
    Route::get('items', [ItemController::Class, 'index']);
    Route::post('items', [ItemController::Class, 'store']);
    Route::get('items/{item}', [ItemController::Class, 'show']);
    Route::get('items/user/{user}', [ItemController::Class, 'showByUser']);
});
