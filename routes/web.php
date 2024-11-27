<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TestController,
    DashboardController
};

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

Route::group(['middleware' => ['session_key']],function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [MainController::class, 'profile'])->name('profile');
    Route::get('/logout', [MainController::class, 'logout'])->name('logout');
    Route::get('/lobby', [MainController::class, 'lobby'])->name('lobby');

});
