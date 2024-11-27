<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TestController,
    DashboardController,
    MainController
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
    Route::post('/logout', [MainController::class, 'logout'])->name('logout');
    Route::get('/lobby', [MainController::class, 'lobby'])->name('lobby');
    Route::get('/get-notification', [MainController::class, 'getNotifications'])->name('getnotif');
    Route::post('/update-notif', [MainController::class, 'updateNotifIsread'])->name('updatenotif');





    
    Route::get('/master', [TestController::class, 'tes'])->name('master');
    Route::get('/bengkel', [TestController::class, 'tes'])->name('bengkel');
    Route::get('/price-service', [TestController::class, 'tes'])->name('price-service');
    Route::get('/regional', [TestController::class, 'tes'])->name('regional');
    Route::get('/area', [TestController::class, 'tes'])->name('area');
    Route::get('/branch', [TestController::class, 'tes'])->name('branch');
    Route::get('/vehicle', [TestController::class, 'tes'])->name('vehicle');
    Route::get('/vehicle-type', [TestController::class, 'tes'])->name('vehicle-type');
    Route::get('/spk-proses', [TestController::class, 'tes'])->name('spk-proses');
    Route::get('/invoice', [TestController::class, 'tes'])->name('invoice');
    Route::get('/report', [TestController::class, 'tes'])->name('report');
    Route::get('/other-feature', [TestController::class, 'tes'])->name('other-feature');
    Route::get('/spk-status', [TestController::class, 'tes'])->name('spk-status');
    Route::get('/spk-list-service', [TestController::class, 'tes'])->name('spk-list-service');
    Route::get('/invoice-bengkel', [TestController::class, 'tes'])->name('invoice-bengkel');
    Route::get('/invoice-client', [TestController::class, 'tes'])->name('invoice-client');
    Route::get('/report-history-service', [TestController::class, 'tes'])->name('report-history-service');
    Route::get('/report-realisasi-spk', [TestController::class, 'tes'])->name('report-realisasi-spk');
    Route::get('/report-rekap-invoice', [TestController::class, 'tes'])->name('report-rekap-invoice');
    Route::get('/report-spk-history', [TestController::class, 'tes'])->name('report-spk-history');
    Route::get('/report-summary-bengkel', [TestController::class, 'tes'])->name('report-summary-bengkel');
    Route::get('/report-service-duedate', [TestController::class, 'tes'])->name('report-service-duedate');
    Route::get('/report-laba-rugi', [TestController::class, 'tes'])->name('report-laba-rugi');
    Route::get('/direct-service', [TestController::class, 'tes'])->name('direct-service');
    Route::get('/vehicle-check', [TestController::class, 'tes'])->name('vehicle-check');
    Route::get('/gps-check', [TestController::class, 'tes'])->name('gps-check');




    
});
