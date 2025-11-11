<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('hello');
});

Route::view('/jurnal', 'pages.transaksi.jurnal')->name('jurnal.index');
Route::view('/buku-besar', 'pages.transaksi.buku_besar')->name('buku_besar.index');
Route::view('/neraca-saldo', 'pages.transaksi.neraca_saldo')->name('neraca_saldo.index');
Route::view('/neraca-ses', 'pages.transaksi.neraca_saldo_pen')->name('neraca_ses.index');

Route::view('/laba-rugi', 'pages.laporan.labarugi')->name('laba_rugi.index');
Route::view('/posisi-keuangan', 'pages.laporan.posisi_keuangan')->name('posisi_keuangan.index');
Route::view('/perubahan-modal', 'pages.laporan.perubahan_modal')->name('perubahan_modal.index');


use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


use App\Http\Controllers\LabaRugiController;

Route::get('/laporan/laba-rugi', [LabaRugiController::class, 'index'])->name('laporan.labarugi.index');
Route::post('/laporan/laba-rugi/generate', [LabaRugiController::class, 'generate'])->name('laporan.labarugi.generate');
