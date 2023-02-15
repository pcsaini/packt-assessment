<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookController;
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

Route::post('auth/login', [AuthController::class, 'login']);

Route::get('books', [BookController::class, 'index']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('auth/logout', [UserController::class, 'logout']);

    Route::get('users/me', [UserController::class, 'profile']);

    Route::prefix('admin')->group(function () {
        Route::get('books', [AdminBookController::class, 'index']);
        Route::delete('books/{id}/delete', [AdminBookController::class, 'delete']);
    });
});
