<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::post('/register', [ApiAuthController::class, 'register']);

    Route::middleware(['auth:sanctum'])->group(function(){
        Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout');
        Route::post('/refresh-token', [ApiAuthController::class, 'refreshToken']);
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/user/{id}/upload', [FileController::class, 'upload']);
        Route::delete('/files/{filePath}', [FileController::class, 'delete']);
    });
});
