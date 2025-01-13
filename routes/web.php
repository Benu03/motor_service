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


    Route::post('/spk-proses', [SPKController::class, 'SpkProcess'])->name('spk-proses');
    Route::get('/spk-history', [SPKController::class, 'index'])->name('spk-history');
    Route::get('/spk-status', [SPKController::class, 'SpkStatus'])->name('spk-status');
    Route::get('/spk-list-service', [SPKController::class, 'SpkListService'])->name('spk-list-service');
    Route::get('/get-spk-list-service', [SPKController::class, 'GetSpkListService'])->name('get-spk-list-service');
    Route::get('/get-spk-list-service-detail', [SPKController::class, 'GetSpkListServiceDetail'])->name('get-spk-list-service-detail');
    Route::get('/spk-service-proses', [SPKController::class, 'SpkServiceProcess'])->name('spk-service-proses');
    

    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::get('/invoice-bengkel', [InvoiceController::class, 'InvoiceBengkel'])->name('invoice-bengkel');
    Route::get('/invoice-client', [InvoiceController::class, 'InvoiceClient'])->name('invoice-client');
    Route::get('/invoice-client-create', [InvoiceController::class, 'InvoiceClientCreate'])->name('invoice-client-create');
    Route::get('/invoice-client-create-gps', [InvoiceController::class, 'InvoiceClientCreateGps'])->name('invoice-client-create-gps');


    Route::get('/other-feature', [FeatureController::class, 'index'])->name('other-feature');
    Route::get('/vehicle-check', [FeatureController::class, 'VehicleCheck'])->name('vehicle-check');
    Route::get('/gps-check', [FeatureController::class, 'GpsCheck'])->name('gps-check');


    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report-history-service', [ReportController::class, 'ReportHistoryService'])->name('report-history-service');
    Route::get('/report-realisasi-spk', [ReportController::class, 'ReportRealisasiSpk'])->name('report-realisasi-spk');
    Route::get('/report-rekap-invoice', [ReportController::class, 'ReportRekapInvoice'])->name('report-rekap-invoice');
    Route::get('/report-spk-history', [ReportController::class, 'ReportSpkHistory'])->name('report-spk-history');
    Route::get('/report-summary-bengkel', [ReportController::class, 'ReportSummaryBengkel'])->name('report-summary-bengkel');
    Route::get('/report-service-duedate', [ReportController::class, 'ReportServicedueDate'])->name('report-service-duedate');
    Route::get('/report-laba-rugi', [ReportController::class, 'ReportLabaRugi'])->name('report-laba-rugi');


    Route::get('/direct-service', [ServicesController::class, 'directService'])->name('direct-service');
    Route::post('/direct-service-process', [ServicesController::class, 'directServiceProcess'])->name('direct-service-process');
    Route::get('/service-list-bengkel', [TestController::class, 'index'])->name('service-list-bengkel');
    Route::get('/service-bengkel', [TestController::class, 'index'])->name('service-bengkel');
    Route::get('/vehicle-list', [TestController::class, 'index'])->name('vehicle-list');
    Route::get('/vehicle-type-client', [TestController::class, 'index'])->name('vehicle-type-client');
    Route::get('/vehicle-client', [TestController::class, 'index'])->name('vehicle-client');


    Route::get('/master', [MasterController::class, 'index'])->name('master');
    Route::get('/bengkel', [MasterController::class, 'Bengkel'])->name('bengkel');
    Route::get('/price-service', [MasterController::class, 'PriceService'])->name('price-service');
    Route::get('/regional', [MasterController::class, 'Regional'])->name('regional');

    Route::post('/get-area-client', [MasterController::class, 'getAreaClient'])->name('get-area-client');
    
    
    Route::get('/area', [MasterController::class, 'Area'])->name('area');
    Route::get('/get-area', [MasterController::class, 'getArea'])->name('get-area');
    Route::post('/area-add', [MasterController::class, 'AreaAdd'])->name('area-add');
    Route::post('/area-proses', [MasterController::class, 'Areaproses'])->name('area-proses');
    Route::get('/edit-area/{data}', [MasterController::class, 'EditArea'])->name('edit-area');
    Route::post('/edit-area-process', [MasterController::class, 'EditAreaProcess'])->name('edit-area-process');
    Route::get('/delete-area/{data}', [MasterController::class, 'deleteArea'])->name('delete-area');
    Route::get('/area-export', [MasterController::class, 'AreaExport'])->name('area-export');


    Route::post('/get-branch-pic-client', [MasterController::class, 'getBranchpicClient'])->name('get-branch-pic-client');
    Route::get('/branch', [MasterController::class, 'Branch'])->name('branch');
    Route::post('/branch-add', [MasterController::class, 'BranchAdd'])->name('branch-add');
    Route::post('/branch-proses', [MasterController::class, 'Branchproses'])->name('branch-proses');
    Route::get('/get-branch', [MasterController::class, 'getBranch'])->name('get-branch');
    Route::get('/branch-export', [MasterController::class, 'BranchExport'])->name('branch-export');
    Route::get('/branch-upload-template', [MasterController::class, 'BranchUploadTemp'])->name('branch-upload-template');
    Route::post('/branch-upload-process', [MasterController::class, 'BranchUploadProcess'])->name('branch-upload-process');
    Route::get('/edit-branch/{data}', [MasterController::class, 'EditBranch'])->name('edit-branch');
    Route::post('/edit-branch-process', [MasterController::class, 'EditBranchProcess'])->name('edit-branch-process');
    Route::get('/delete-branch/{data}', [MasterController::class, 'deleteBranch'])->name('delete-branch');
    Route::get('/vehicle', [MasterController::class, 'Vehicle'])->name('vehicle');
    Route::get('/get-vehicle', [MasterController::class, 'getVehicle'])->name('get-vehicle');
    Route::post('/vehicle-add', [MasterController::class, 'VehicleAdd'])->name('vehicle-add');
    Route::post('/vehicle-proses', [MasterController::class, 'Vehicleproses'])->name('vehicle-proses');
    Route::get('/edit-vehicle/{data}', [MasterController::class, 'EditVehicle'])->name('edit-vehicle');
    Route::post('/edit-vehicle-process', [MasterController::class, 'EditVehicleProcess'])->name('edit-vehicle-process');
    Route::get('/delete-vehicle/{data}', [MasterController::class, 'deleteVehicle'])->name('delete-vehicle');
    Route::get('/vehicle-detail/{data}', [MasterController::class, 'VehicleDetail'])->name('vehicle-detail');
    Route::get('/vehicle-template-upload', [MasterController::class, 'VehicleTemplateUpload'])->name('vehicle-template-upload');
    Route::post('/vehicle-upload', [MasterController::class, 'VehicleUpload'])->name('vehicle-upload');
    Route::get('/vehicle-export', [MasterController::class, 'VehicleExport'])->name('vehicle-export');
    Route::get('/vehicle-type', [MasterController::class, 'VehicleType'])->name('vehicle-type');
    Route::post('/vehicle-type-process', [MasterController::class, 'VehicleTypeProcess'])->name('vehicle-type-process');
    Route::get('/get-vehicle-type', [MasterController::class, 'getVehicletype'])->name('get-vehicle-type');
    Route::post('/vehicle-type-add', [MasterController::class, 'VehicleTypeAdd'])->name('vehicle-type-add');
    Route::get('/edit-vehicle-type/{data}', [MasterController::class, 'EditVehicleType'])->name('edit-vehicle-type');
    Route::post('/edit-vehicle-type-process', [MasterController::class, 'EditVehicleTypeProcess'])->name('edit-vehicle-type-process');
    Route::get('/delete-vehicle-type/{data}', [MasterController::class, 'DeleteVehicleType'])->name('delete-vehicle-type');


    Route::get('/approval', [ApprovalController::class, 'index'])->name('approval');
    Route::get('/approval-service', [ApprovalController::class, 'ApprovalService'])->name('approval-service');
    Route::get('/approval-direct', [ApprovalController::class, 'ApprovalDirect'])->name('approval-direct');







    




    
});
