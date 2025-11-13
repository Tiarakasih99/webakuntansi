<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    // Tampilkan halaman form laporan laba rugi
    public function index()
    {
        return view('pages.laporan.labarugi');
    }

    // Proses generate laporan (misal: filter tanggal, hitung laba, dsb)
    public function generate(Request $request)
    {
        // contoh dummy data (nanti kamu bisa ganti ambil dari database)
        $laporan = [
            'pendapatan' => 15000000,
            'pengeluaran' => 8000000,
            'laba_bersih' => 7000000,
        ];

        return view('pages.laporan.labarugi', compact('laporan'));
    }
}
