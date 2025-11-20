<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Halaman form laporan keuangan
    public function index()
    {
        return view('reports.index');
    }

    // Generate laporan berdasarkan input form
    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required|in:balance_sheet,income_statement',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
        ]);

        $start = $request->period_start;
        $end = $request->period_end;
        $type = $request->type;

        // Contoh query sederhana untuk neraca saldo
        if ($type == 'balance_sheet') {
            $accounts = Account::all();

            $data = [];
            foreach ($accounts as $account) {
                $debit = $account->journalEntries()->whereHas('journal', function ($q) use ($start, $end) {
                    $q->whereBetween('date', [$start, $end]);
                })->sum('debit');

                $credit = $account->journalEntries()->whereHas('journal', function ($q) use ($start, $end) {
                    $q->whereBetween('date', [$start, $end]);
                })->sum('credit');

                $data[] = [
                    'account' => $account->name,
                    'debit' => $debit,
                    'credit' => $credit,
                ];
            }

            return view('reports.trial-balance', compact('data'));
        }

        // Untuk laporan laba rugi, logika serupa bisa dibuat sesuai kebutuhan
    }

    // Halaman neraca saldo (optional langsung akses)
    public function trialBalance()
    {
        $accounts = Account::all();

        $data = [];
        foreach ($accounts as $account) {
            $debit = $account->journalEntries()->sum('debit');
            $credit = $account->journalEntries()->sum('credit');

            $data[] = [
                'account' => $account->name,
                'debit' => $debit,
                'credit' => $credit,
            ];
        }

        return view('reports.trial-balance', compact('data'));
    }
}
