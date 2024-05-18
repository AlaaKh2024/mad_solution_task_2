<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth', function () {
    return view('auth');
});

Route::post('/register', [ApiAuthController::class, 'register'])->name('register');
Route::post('/login', [ApiAuthController::class, 'login'])->name('login');
Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout');
Route::get('/profile', [UserController::class,'profile'])->name('user.profile');
