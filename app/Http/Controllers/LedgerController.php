<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use PDF;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $accounts = Account::with(['category', 'journalEntries.journal'])
            ->get()
            ->sortBy(function ($account) {
                $type = strtolower($account->category->name ?? '');
                return match ($type) {
                    'asset' => 1,
                    'liability' => 2,
                    'equity' => 3,
                    'revenue' => 4,
                    'expense' => 5,
                    default => 6,
                };
            });

        $ledgerData = [];

        foreach ($accounts as $account) {
            $entries = [];
            $balance = 0;

            $normal = strtolower($account->category->normal_balance ?? 'debit');
            if (strtolower($account->name) === 'prive') {
                $normal = 'debit';
            }

            $journals = $account->journalEntries
                ->filter(function ($entry) use ($startDate, $endDate) {
                    if ($startDate && $endDate) {
                        return $entry->journal->date >= $startDate &&
                               $entry->journal->date <= $endDate;
                    }
                    return true;
                })
                ->sortBy('journal.date');

            foreach ($journals as $entry) {
                if ($normal === 'debit') {
                    $balance += ($entry->debit - $entry->credit);
                } else {
                    $balance += ($entry->credit - $entry->debit);
                }

                $name = strtolower($account->name);
                if ($name === 'prive' || $name === 'akumulasi penyusutan peralatan') {
                    $balance = abs($balance);
                }

                $entries[] = [
                    'date' => $entry->journal->date,
                    'debit' => $entry->debit,
                    'credit' => $entry->credit,
                    'balance' => $balance,
                ];
            }

            $ledgerData[] = [
                'code' => $account->code,
                'name' => $account->name,
                'entries' => $entries,
            ];
        }

        return view('ledgers.index', [
            'accounts' => $ledgerData,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    // =======================
    // EXPORT PDF (BUKU BESAR)
    // =======================
    public function exportPdf(Request $request)
    {
        // 🔥 LOGIKA DISAMAKAN 100% DENGAN INDEX
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $accounts = Account::with(['category', 'journalEntries.journal'])
            ->get()
            ->sortBy(function ($account) {
                $type = strtolower($account->category->name ?? '');
                return match ($type) {
                    'asset' => 1,
                    'liability' => 2,
                    'equity' => 3,
                    'revenue' => 4,
                    'expense' => 5,
                    default => 6,
                };
            });

        $ledgerData = [];

        foreach ($accounts as $account) {
            $entries = [];
            $balance = 0;

            $normal = strtolower($account->category->normal_balance ?? 'debit');
            if (strtolower($account->name) === 'prive') {
                $normal = 'debit';
            }

            $journals = $account->journalEntries
                ->filter(function ($entry) use ($startDate, $endDate) {
                    if ($startDate && $endDate) {
                        return $entry->journal->date >= $startDate &&
                               $entry->journal->date <= $endDate;
                    }
                    return true;
                })
                ->sortBy('journal.date');

            foreach ($journals as $entry) {
                if ($normal === 'debit') {
                    $balance += ($entry->debit - $entry->credit);
                } else {
                    $balance += ($entry->credit - $entry->debit);
                }

                $name = strtolower($account->name);
                if ($name === 'prive' || $name === 'akumulasi penyusutan peralatan') {
                    $balance = abs($balance);
                }

                $entries[] = [
                    'date' => $entry->journal->date,
                    'debit' => $entry->debit,
                    'credit' => $entry->credit,
                    'balance' => $balance, // ✅ SEKARANG ADA
                ];
            }

            if (count($entries) > 0) {
                $ledgerData[] = [
                    'code' => $account->code,
                    'name' => $account->name,
                    'entries' => $entries,
                ];
            }
        }

        $pdf = PDF::loadView('ledgers.ledger-pdf', [
            'accounts' => $ledgerData,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('Buku_Besar.pdf');
    }
}
