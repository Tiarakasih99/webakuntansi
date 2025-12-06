<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrialBalanceController;

// Route::get('/', function () {
//     return view('compro.home');
// });

Route::view('/jurnal', 'pages.transaksi.jurnal')->name('jurnal.index');
Route::view('/buku-besar', 'pages.transaksi.buku_besar')->name('buku_besar.index');
Route::view('/neraca-saldo', 'pages.transaksi.neraca_saldo')->name('neraca_saldo.index');
Route::view('/neraca-ses', 'pages.transaksi.neraca_saldo_pen')->name('neraca_ses.index');

// Route::view('/laba-rugi', 'pages.laporan.labarugi')->name('laba_rugi.index');
// Route::view('/posisi-keuangan', 'pages.laporan.posisi_keuangan')->name('posisi_keuangan.index');
// Route::view('/perubahan-modal', 'pages.laporan.perubahan_modal')->name('perubahan_modal.index');


Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
Route::get('/reports/trial-balance', [ReportController::class, 'trialBalance'])->name('reports.trial-balance');


use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


use App\Http\Controllers\LabaRugiController;

Route::get('/laporan/laba-rugi', [LabaRugiController::class, 'index'])->name('laporan.labarugi.index');
Route::post('/laporan/laba-rugi/generate', [LabaRugiController::class, 'generate'])->name('laporan.labarugi.generate');



// Route::resource('accounts', AccountController::class);
// Route::resource('journals', JournalController::class);
// Route::resource('ledgers', LedgerController::class);
// Route::get('trial-balance', [ReportController::class, 'trialBalance'])->name('trial-balance.index');
// Route::get('financial-reports', [ReportController::class, 'index'])->name('financial-reports.index');
// Route::post('financial-reports/generate', [ReportController::class, 'generate'])->name('financial-reports.generate');


// Halaman utama, bisa redirect ke jurnal misalnya
Route::get('/', function () {
    return redirect()->route('journals.index');
});

// Resource routes untuk Akun Perkiraan (CRUD lengkap)
Route::resource('accounts', AccountController::class);

// Resource routes untuk Jurnal Umum (CRUD lengkap)
Route::resource('journals', JournalController::class);

// Route khusus untuk Jurnal Penyesuaian (penyesuaian bisa tampil mirip jurnal tapi filter)
Route::get('journals/adjustment', [JournalController::class, 'adjustment'])->name('journals.adjustment');

// Resource routes untuk Buku Besar (biasanya hanya index untuk lihat laporan)
Route::resource('ledgers', LedgerController::class)->only(['index']);

// Route untuk Neraca Saldo
// Route::get('trial-balance', [ReportController::class, 'trialBalance'])->name('trial-balance.index');

Route::get('trial-balance', [TrialBalanceController::class, 'index'])->name('trial.balance');


// // Route untuk Laporan Keuangan (form dan generate laporan)
// Route::get('financial-reports', [ReportController::class, 'index'])->name('financial-reports.index');
// Route::post('financial-reports/generate', [ReportController::class, 'generate'])->name('financial-reports.generate');
// Route::post('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.exportPdf');
// Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
// Route::post('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.exportPdf');
     

// Route::get('financial-reports', [ReportController::class, 'index'])->name('financial-reports.index');

// Route::post('financial-reports/generate', [ReportController::class, 'generate'])
//     ->name('financial-reports.generate');

// Route::post('reports/export-pdf', [ReportController::class, 'exportPdf'])
//     ->name('reports.exportPdf');



Route::get('financial-reports', [ReportController::class, 'index'])
    ->name('financial-reports.index');

Route::post('financial-reports/generate', [ReportController::class, 'generate'])
    ->name('financial-reports.generate');


Route::post('reports/export-pdf', [ReportController::class, 'exportPdf'])
    ->name('reports.exportPdf');

Route::post('/reports/export-income', [ReportController::class, 'exportIncomePdf'])
    ->name('reports.exportIncomePdf');
Route::post('/reports/export-equity', [ReportController::class, 'exportEquityPdf'])
    ->name('reports.exportEquityPdf');