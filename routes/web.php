<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    KamarController,
    ReservasiController,
    CheckinController,
    CheckoutController,
    PelangganController,
    LaporanController,
    DashboardController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ===============================
    // MODUL UTAMA
    // ===============================
    Route::resource('kamar', KamarController::class);
    Route::put(
        '/kamar/{id}/selesai-maintenance',
        [KamarController::class, 'selesaiMaintenance']
    )->name('kamar.selesaiMaintenance');

    // Route::resource('reservasi', ReservasiController::class);
    Route::resource('checkin', CheckinController::class);
    // Route::resource('checkout', CheckoutController::class);
    Route::resource('pelanggan', PelangganController::class);

    Route::put('/checkin/{id}/checkout', [CheckinController::class, 'checkout'])
        ->name('checkin.checkout');
    Route::get('/checkin/{id}/bayar', [CheckinController::class, 'bayar'])
        ->name('checkin.bayar');
    Route::put('/checkin/{id}/bayar', [CheckinController::class, 'prosesBayar'])
        ->name('checkin.prosesBayar');
    Route::get('/checkin/{id}/invoice', [CheckinController::class, 'invoice'])
        ->name('checkin.invoice');

    // ===============================
    // AKSES FILE KTP PRIVATE
    // ===============================
    Route::get('/ktp/{filename}', function ($filename) {
        $path = storage_path('app/ktp/' . $filename);
        abort_unless(file_exists($path), 404);
        return response()->file($path);
    })->name('ktp.view');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
});

require __DIR__ . '/auth.php';
