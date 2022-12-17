<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login_rquest', [AuthController::class, 'loginRquest'])->name('login_rquest');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register_rquest', [AuthController::class, 'registerRquest'])->name('register_rquest');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
