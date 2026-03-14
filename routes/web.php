<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\SettingController;
/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/otp/request', [AuthController::class, 'showOtpRequestForm'])->name('otp.request.form');
    Route::post('/otp/request', [AuthController::class, 'requestOtp'])->name('otp.request');
    Route::get('/otp/verify', [AuthController::class, 'showOtpVerifyForm'])->name('otp.verify.form');
    Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Products
    Route::resource('products', ProductController::class);

    // Receipts
    Route::post('receipts/{receipt}/validate', [ReceiptController::class, 'validateReceipt'])->name('receipts.validate');
    Route::resource('receipts', ReceiptController::class);

    // Deliveries
    Route::post('deliveries/{delivery}/validate', [DeliveryController::class, 'validateDelivery'])->name('deliveries.validate');
    Route::resource('deliveries', DeliveryController::class);

    // Transfers
    Route::post('transfers/{transfer}/validate', [TransferController::class, 'validateTransfer'])->name('transfers.validate');
    Route::resource('transfers', TransferController::class);

    // Adjustments
    Route::post('adjustments/{adjustment}/validate', [AdjustmentController::class, 'validateAdjustment'])->name('adjustments.validate');
    Route::resource('adjustments', AdjustmentController::class);

    // Stock Ledger
    Route::get('/ledger', [LedgerController::class, 'index'])->name('ledger.index');

    // Settings & Profile
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/warehouse', [SettingController::class, 'storeWarehouse'])->name('settings.warehouse.store');
    Route::get('/settings/warehouse/{warehouse}/edit', [SettingController::class, 'editWarehouse'])->name('settings.warehouse.edit');
    Route::put('/settings/warehouse/{warehouse}', [SettingController::class, 'updateWarehouse'])->name('settings.warehouse.update');
    Route::delete('/settings/warehouse/{warehouse}', [SettingController::class, 'destroyWarehouse'])->name('settings.warehouse.destroy');

    Route::post('/settings/location', [SettingController::class, 'storeLocation'])->name('settings.location.store');
    Route::delete('/settings/location/{location}', [SettingController::class, 'destroyLocation'])->name('settings.location.destroy');
    Route::get('/profile', function () { return view('profile.index'); })->name('profile.index');
});
