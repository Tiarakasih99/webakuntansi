<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class TrialBalanceController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Ambil akun beserta kategori dan jurnalnya
        $accounts = Account::with(['journalEntries.journal', 'category'])
            ->join('account_categories as ac', 'accounts.category_id', '=', 'ac.id')
            ->orderByRaw("
                CASE 
                    WHEN ac.name = 'Asset' THEN 1
                    WHEN ac.name = 'Liability' THEN 2
                    WHEN ac.name = 'Equity' THEN 3
                    WHEN ac.name = 'Revenue' THEN 4
                    WHEN ac.name = 'Expense' THEN 5
                    ELSE 6
                END,
                accounts.code
            ")
            ->select('accounts.*', 'ac.name as type')
            ->get();

        $data = [];
        $totalDebit = 0;
        $totalCredit = 0;

        // Normal balance
        $normalDebit = ['Asset', 'Expense'];
        $normalCredit = ['Liability', 'Equity', 'Revenue'];

        foreach ($accounts as $account) {

            // saldo awal (bisa kosong = 0)
            $balance = $account->balance ?? 0;

            $totalDebits = 0;
            $totalCredits = 0;

            // Hitung pergerakan jurnal dalam rentang tanggal
            foreach ($account->journalEntries as $entry) {

                $entryDate = $entry->journal->date;

                if ($startDate && $endDate) {
                    if ($entryDate < $startDate || $entryDate > $endDate) {
                        continue;
                    }
                }

                $totalDebits += $entry->debit;
                $totalCredits += $entry->credit;
            }

            // Hitung saldo akhir sesuai normal balance
            if (in_array($account->type, $normalDebit)) {
                // Asset / Expense = saldo debit
                $ending = $balance + ($totalDebits - $totalCredits);

                $debit = $ending >= 0 ? $ending : 0;
                $credit = $ending < 0 ? abs($ending) : 0;

            } else {
                // Liability / Equity / Revenue = saldo kredit
                $ending = $balance + ($totalCredits - $totalDebits);

                $credit = $ending >= 0 ? $ending : 0;
                $debit = $ending < 0 ? abs($ending) : 0;
            }

            $totalDebit += $debit;
            $totalCredit += $credit;

            $data[] = [
                'code'   => $account->code,
                'name'   => $account->name,
                'debit'  => $debit,
                'credit' => $credit,
            ];
        }

        return view('reports.trial-balance', compact(
            'data', 'totalDebit', 'totalCredit', 'startDate', 'endDate'
        ));
    }
}
