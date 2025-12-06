<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\JournalEntry;

class LabaRugiController extends Controller
{
    public function index()
    {
        return view('pages.laporan.labarugi');
    }

    public function generate(Request $request)
    {
        $start = $request->period_start;
        $end   = $request->period_end;

        // =============================
        //        PENDAPATAN (4xxx)
        // =============================
        $totalPendapatan = JournalEntry::whereHas('account', function($q){
                $q->where('code', 'like', '4%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]))
            ->sum('credit');

        // =============================
        //        HPP (5xxx)
        // =============================
        $totalHPP = JournalEntry::whereHas('account', function($q){
                $q->where('code', 'like', '5%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]))
            ->sum('debit');

        $labaKotor = $totalPendapatan - $totalHPP;

        // =============================
        //   BEBAN OPERASIONAL (6xxx)
        // =============================
        $totalOperasional = JournalEntry::whereHas('account', function($q){
                $q->where('code', 'like', '6%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]))
            ->sum('debit');

        // =============================
        //   PENDAPATAN NON-OP (7xxx)
        // =============================
        $pendNonOp = JournalEntry::whereHas('account', function($q){
                $q->where('code', 'like', '7%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]))
            ->sum('credit');

        // =============================
        //   BEBAN NON-OP (8xxx)
        // =============================
        $bebanNonOp = JournalEntry::whereHas('account', function($q){
                $q->where('code', 'like', '8%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]))
            ->sum('debit');

        // =============================
        //         LABA BERSIH
        // =============================
        $labaBersih = $labaKotor - $totalOperasional + ($pendNonOp - $bebanNonOp);

        return view('reports.income-statement', compact(
            'start','end',
            'totalPendapatan',
            'totalHPP',
            'labaKotor',
            'totalOperasional',
            'pendNonOp',
            'bebanNonOp',
            'labaBersih'
        ));
    }

}
