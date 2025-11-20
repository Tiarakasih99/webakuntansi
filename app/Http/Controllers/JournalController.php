<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    // Tampilkan daftar jurnal umum
    public function index()
    {
        $journals = Journal::orderBy('date', 'desc')->paginate(10);
        return view('journals.index', compact('journals'));
    }

    // Form input jurnal baru
    public function create()
    {
        $accounts = Account::orderBy('code')->get();
        return view('journals.create', compact('accounts'));
    }

    // Simpan jurnal dan entri terkait dengan transaksi DB
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'entries' => 'required|array|min:1',
            'entries.*.account_id' => 'required|exists:accounts,id',
            'entries.*.debit' => 'nullable|numeric|min:0',
            'entries.*.credit' => 'nullable|numeric|min:0',
        ]);

        $totalDebit = collect($request->entries)->sum('debit');
        $totalCredit = collect($request->entries)->sum('credit');

        if ($totalDebit != $totalCredit) {
            return back()->withErrors('Total debit dan kredit harus sama!')->withInput();
        }

        DB::transaction(function () use ($request, $totalDebit) {
            $lastJournal = Journal::orderByDesc('id')->first();
            $transactionNumber = $lastJournal ? $lastJournal->transaction_number + 1 : 1;

            $journal = Journal::create([
                'transaction_number' => $transactionNumber,
                'date' => $request->date,
                'total' => $totalDebit,
                'description' => $request->description ?? null,
            ]);

            foreach ($request->entries as $entry) {
                $je = JournalEntry::create([
                    'journal_id' => $journal->id,
                    'account_id' => $entry['account_id'],
                    'debit' => $entry['debit'] ?? 0,
                    'credit' => $entry['credit'] ?? 0,
                    'description' => $entry['description'] ?? null,
                ]);

                // Update atau buat ledger (saldo kumulatif)
                $account = Account::findOrFail($entry['account_id']);
                $lastBalance = Ledger::where('account_id', $account->id)->latest()->value('balance') ?? $account->balance;

                Ledger::create([
                    'account_id' => $account->id,
                    'journal_entry_id' => $je->id,
                    'date' => $journal->date,
                    'debit' => $entry['debit'] ?? 0,
                    'credit' => $entry['credit'] ?? 0,
                    'balance' => $lastBalance + ($entry['debit'] ?? 0) - ($entry['credit'] ?? 0),
                ]);
            }
        });

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil disimpan.');
    }

    // Lihat detail jurnal
    public function show(Journal $journal)
    {
        $journal->load('entries.account');
        return view('journals.show', compact('journal'));
    }

    // Jurnal penyesuaian bisa dibuat method dan view terpisah jika berbeda perlakuan
    public function adjustment()
    {
        // logika serupa dengan index, bisa difilter
        $journals = Journal::where('is_adjustment', true)->paginate(10);
        return view('journals.adjustment', compact('journals'));
    }
}
