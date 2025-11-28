<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Journal;
use App\Models\JournalEntry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Data
        $totalAccounts = Account::count();
        $totalJournals = Journal::count();

        // Total Debit & Kredit
        $totals = JournalEntry::selectRaw("SUM(debit) as total_debit, SUM(credit) as total_credit")
            ->first();

        $totalDebit = $totals->total_debit ?? 0;
        $totalKredit = $totals->total_credit ?? 0;

        // Grafik Transaksi Per Bulan
        $monthlyData = Journal::selectRaw("MONTH(date) as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Convert bulan angka -> nama bulan
        $chartMonths = $monthlyData->pluck('month')->map(function ($m) {
            return date('F', mktime(0, 0, 0, $m, 1)); // example: 1 -> January
        });

        // Total transaksi
        $chartTotals = $monthlyData->pluck('total');

        // 5 transaksi terbaru
        $recentJournals = Journal::orderBy('date', 'desc')->limit(5)->get();

        return view('dashboard.index', compact(
            'totalAccounts',
            'totalJournals',
            'totalDebit',
            'totalKredit',
            'chartMonths',
            'chartTotals',
            'recentJournals'
        ));
    }
}
