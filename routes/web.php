<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TestController,
    DashboardController,
    MainController,
    ServicesController,
    MasterController,
    SPKController,
    ReportController,
    ApprovalController,
    InvoiceController,
    FeatureController
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


    Route::get('/direct-service', [ServicesController::class, 'directService'])->name('direct-service');
    Route::post('/direct-service-process', [ServicesController::class, 'directServiceProcess'])->name('direct-service-process');
    Route::get('/service-list-bengkel', [TestController::class, 'index'])->name('service-list-bengkel');
    Route::get('/service-bengkel', [TestController::class, 'index'])->name('service-bengkel');
    Route::get('/vehicle-list', [TestController::class, 'index'])->name('vehicle-list');
    Route::get('/vehicle-type-client', [TestController::class, 'index'])->name('vehicle-type-client');
    Route::get('/vehicle-client', [TestController::class, 'index'])->name('vehicle-client');


    Route::get('/master', [MasterController::class, 'index'])->name('master');
    Route::get('/bengkel', [MasterController::class, 'index'])->name('bengkel');
    Route::get('/price-service', [MasterController::class, 'index'])->name('price-service');
    Route::get('/regional', [MasterController::class, 'index'])->name('regional');
    Route::get('/area', [MasterController::class, 'index'])->name('area');
    Route::get('/branch', [MasterController::class, 'index'])->name('branch');
    Route::get('/vehicle', [MasterController::class, 'index'])->name('vehicle');
    Route::get('/vehicle-type', [MasterController::class, 'index'])->name('vehicle-type');


    Route::post('/spk-proses', [SPKController::class, 'SpkProcess'])->name('spk-proses');
    Route::get('/spk-history', [SPKController::class, 'index'])->name('spk-history');
    Route::get('/spk-status', [SPKController::class, 'SpkStatus'])->name('spk-status');
    Route::get('/spk-list-service', [SPKController::class, 'index'])->name('spk-list-service');


    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::get('/invoice-bengkel', [InvoiceController::class, 'index'])->name('invoice-bengkel');
    Route::get('/invoice-client', [InvoiceController::class, 'index'])->name('invoice-client');



    Route::get('/other-feature', [FeatureController::class, 'index'])->name('other-feature');
    Route::get('/vehicle-check', [FeatureController::class, 'index'])->name('vehicle-check');
    Route::get('/gps-check', [FeatureController::class, 'index'])->name('gps-check');



    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report-history-service', [ReportController::class, 'index'])->name('report-history-service');
    Route::get('/report-realisasi-spk', [ReportController::class, 'index'])->name('report-realisasi-spk');
    Route::get('/report-rekap-invoice', [ReportController::class, 'index'])->name('report-rekap-invoice');
    Route::get('/report-spk-history', [ReportController::class, 'index'])->name('report-spk-history');
    Route::get('/report-summary-bengkel', [ReportController::class, 'index'])->name('report-summary-bengkel');
    Route::get('/report-service-duedate', [ReportController::class, 'index'])->name('report-service-duedate');
    Route::get('/report-laba-rugi', [ReportController::class, 'index'])->name('report-laba-rugi');
 


    Route::get('/approval', [ApprovalController::class, 'index'])->name('approval');
    Route::get('/approval-service', [ApprovalController::class, 'index'])->name('approval-service');
    Route::get('/approval-direct', [ApprovalController::class, 'index'])->name('approval-direct');







    




    
});
