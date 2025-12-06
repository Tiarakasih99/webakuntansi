<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Ambil akun beserta kategori dan journal entries
        $accounts = Account::with(['category', 'journalEntries.journal'])
            ->get()
            ->sortBy(function($account) {
                // Urutan akun sesuai standar akuntansi
                $type = strtolower($account->category->name ?? '');
                switch ($type) {
                    case 'asset': return 1;
                    case 'liability': return 2;
                    case 'equity': return 3;
                    case 'revenue': return 4;
                    case 'expense': return 5;
                    default: return 6;
                }
            });

        $ledgerData = [];

        foreach ($accounts as $account) {
            $entries = [];
            $balance = 0; // saldo awal = 0
            $normal = strtolower($account->category->normal_balance ?? 'debit'); // default debit
            if (strtolower($account->name) === 'Prive') {$normal = 'debit';}
            
            // Filter journal entries sesuai tanggal
            $journals = $account->journalEntries->filter(function($entry) use ($startDate, $endDate) {
                if ($startDate && $endDate) {
                    return $entry->journal->date >= $startDate && $entry->journal->date <= $endDate;
                }
                return true;
            })->sortBy('journal.date');

            foreach ($journals as $entry) {
                if ($normal === 'debit') {
                    $balance += ($entry->debit - $entry->credit);
                } else { // normal credit
                    $balance += ($entry->credit - $entry->debit);
                }

                // Force saldo Prive dan Akumulasi Penyusutan Peralatan selalu positif
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
                // 'normal_balance' => strtolower($account->category->normal_balance ?? 'debit'), // tambah in
                'entries' => $entries,
            ];
        }

        return view('ledgers.index', [
            'accounts' => $ledgerData,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
