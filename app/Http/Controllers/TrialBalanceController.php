<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use PDF;

class TrialBalanceController extends Controller
{
    /**
     * TAMPILAN NERACA SALDO
     */
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $result = $this->buildTrialBalanceData($startDate, $endDate);

        return view('reports.trial-balance', [
            'data'        => $result['data'],
            'totalDebit'  => $result['totalDebit'],
            'totalCredit' => $result['totalCredit'],
            'startDate'   => $startDate,
            'endDate'     => $endDate
        ]);
    }

    /**
     * EXPORT PDF
     */
    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $result = $this->buildTrialBalanceData($startDate, $endDate);

        $pdf = PDF::loadView('reports.trial-balance-pdf', [
            'data'        => $result['data'],
            'totalDebit'  => $result['totalDebit'],
            'totalCredit' => $result['totalCredit'],
            'startDate'   => $startDate,
            'endDate'     => $endDate
        ])->setPaper('A4', 'portrait');

        return $pdf->download('Neraca_Saldo.pdf');
    }

    /**
     * LOGIC PERHITUNGAN (dipakai index & pdf)
     */
    private function buildTrialBalanceData($startDate = null, $endDate = null)
    {
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

        $normalDebit = ['Asset', 'Expense'];
        $normalCredit = ['Liability', 'Equity', 'Revenue'];

        foreach ($accounts as $account) {

            $balance = $account->balance ?? 0;

            $totalDebits = 0;
            $totalCredits = 0;

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

            if (in_array($account->type, $normalDebit)) {
                $ending = $balance + ($totalDebits - $totalCredits);

                $debit = $ending >= 0 ? $ending : 0;
                $credit = $ending < 0 ? abs($ending) : 0;
            } else {
                $ending = $balance + ($totalCredits - $totalDebits);

                $credit = $ending >= 0 ? $ending : 0;
                $debit = $ending < 0 ? abs($ending) : 0;
            }

            if ($debit == 0 && $credit == 0) {
                continue;
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

        return [
            'data'        => $data,
            'totalDebit'  => $totalDebit,
            'totalCredit' => $totalCredit
        ];
    }
}
