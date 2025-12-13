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
        // Normalisasi format tanggal
        $start = date('Y-m-d', strtotime($request->period_start));
        $end   = date('Y-m-d', strtotime($request->period_end));

        // Helper untuk rumus debit/credit yang benar
        $getSaldo = function($query) {
            return $query->get()->sum(function ($item) {
                $normal = $item->account->normal_balance ?? 'debit';
                return $normal === 'debit'
                    ? $item->debit - $item->credit
                    : $item->credit - $item->debit;
            });
        };

        // =============================
        //        PENDAPATAN (4xxx)
        // =============================
        $pendapatanQuery = JournalEntry::whereHas('account', function($q) {
                $q->where('code', 'like', '4%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]));

        $totalPendapatan = $getSaldo($pendapatanQuery);

        // =============================
        //        HPP (5xxx)
        // =============================
        $hppQuery = JournalEntry::whereHas('account', function($q) {
                $q->where('code', 'like', '5%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]));

        $totalHPP = $getSaldo($hppQuery);

        $labaKotor = $totalPendapatan - $totalHPP;

        // =============================
        //   BEBAN OPERASIONAL (6xxx)
        // =============================
        $operasionalQuery = JournalEntry::whereHas('account', function($q) {
                $q->where('code', 'like', '6%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]));

        $totalOperasional = $getSaldo($operasionalQuery);

        // =============================
        //   PENDAPATAN NON-OP (7xxx)
        // =============================
        $nonOpPendQuery = JournalEntry::whereHas('account', function($q) {
                $q->where('code', 'like', '7%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]));

        $pendNonOp = $getSaldo($nonOpPendQuery);

        // =============================
        //   BEBAN NON-OP (8xxx)
        // =============================
        $nonOpBebanQuery = JournalEntry::whereHas('account', function($q) {
                $q->where('code', 'like', '8%');
            })
            ->whereHas('journal', fn($q) => $q->whereBetween('date', [$start, $end]));

        $bebanNonOp = $getSaldo($nonOpBebanQuery);

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
