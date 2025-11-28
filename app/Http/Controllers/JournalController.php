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

        $totalDebit = collect($request->entries)->sum(function ($e) {
            return $e['debit'] ?? 0;
        });
        $totalCredit = collect($request->entries)->sum(function ($e) {
            return $e['credit'] ?? 0;
        });

        if ($totalDebit != $totalCredit) {
            return back()->withErrors('Total debit dan kredit harus sama!')->withInput();
        }

        try {
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
                    // Pastikan nilai debit/credit selalu numerik
                    $debit = $entry['debit'] ?? 0;
                    $credit = $entry['credit'] ?? 0;

                    $je = JournalEntry::create([
                        'journal_id' => $journal->id,
                        'account_id' => $entry['account_id'],
                        'debit' => $debit,
                        'credit' => $credit,
                        'description' => $entry['description'] ?? null,
                    ]);

                    // Update atau buat ledger (saldo kumulatif)
                    $account = Account::findOrFail($entry['account_id']);
                    $lastBalance = Ledger::where('account_id', $account->id)
                        ->latest('date')
                        ->value('balance') ?? $account->balance ?? 0;

                    Ledger::create([
                        'account_id' => $account->id,
                        'journal_entry_id' => $je->id,
                        'date' => $journal->date,
                        'debit' => $debit,
                        'credit' => $credit,
                        'balance' => $lastBalance + $debit - $credit,
                    ]);
                }
            });
        } catch (\Exception $e) {
            // Menangkap error supaya bisa langsung kelihatan
            return back()->withErrors('Terjadi kesalahan saat menyimpan jurnal: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil disimpan.');
    }

    // Lihat detail jurnal
    public function show(Journal $journal)
    {
        $journal->load('entries.account');
        return view('journals.show', compact('journal'));
    }

    // Form edit jurnal
    public function edit(Journal $journal)
    {
        $accounts = Account::orderBy('code')->get();
        $journal->load('entries'); // Load entries untuk form edit
        return view('journals.edit', compact('journal', 'accounts'));
    }

    // Update jurnal dan entri terkait
    public function update(Request $request, Journal $journal)
    {
        $request->validate([
            'date' => 'required|date',
            'entries' => 'required|array|min:1',
            'entries.*.account_id' => 'required|exists:accounts,id',
            'entries.*.debit' => 'nullable|numeric|min:0',
            'entries.*.credit' => 'nullable|numeric|min:0',
        ]);

        $totalDebit = collect($request->entries)->sum(function ($e) {
            return $e['debit'] ?? 0;
        });
        $totalCredit = collect($request->entries)->sum(function ($e) {
            return $e['credit'] ?? 0;
        });

        if ($totalDebit != $totalCredit) {
            return back()->withErrors('Total debit dan kredit harus sama!')->withInput();
        }

        try {
            DB::transaction(function () use ($request, $journal, $totalDebit) {
                // Update jurnal
                $journal->update([
                    'date' => $request->date,
                    'total' => $totalDebit,
                    'description' => $request->description ?? null,
                ]);

                // Hapus entries dan ledger lama
                $journal->entries()->delete(); // Ini akan cascade delete ledger jika relasi diatur
                // Jika tidak cascade, hapus manual: Ledger::whereIn('journal_entry_id', $journal->entries->pluck('id'))->delete();

                // Buat ulang entries dan ledger
                foreach ($request->entries as $entry) {
                    $debit = $entry['debit'] ?? 0;
                    $credit = $entry['credit'] ?? 0;

                    $je = JournalEntry::create([
                        'journal_id' => $journal->id,
                        'account_id' => $entry['account_id'],
                        'debit' => $debit,
                        'credit' => $credit,
                        'description' => $entry['description'] ?? null,
                    ]);

                    // Update ledger
                    $account = Account::findOrFail($entry['account_id']);
                    $lastBalance = Ledger::where('account_id', $account->id)
                        ->where('date', '<=', $journal->date)
                        ->latest('date')
                        ->value('balance') ?? $account->balance ?? 0;

                    Ledger::create([
                        'account_id' => $account->id,
                        'journal_entry_id' => $je->id,
                        'date' => $journal->date,
                        'debit' => $debit,
                        'credit' => $credit,
                        'balance' => $lastBalance + $debit - $credit,
                    ]);
                }
            });
        } catch (\Exception $e) {
            return back()->withErrors('Terjadi kesalahan saat update jurnal: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil diperbarui.');
    }

    // Hapus jurnal dan entri terkait
    public function destroy(Journal $journal)
    {
        try {
            DB::transaction(function () use ($journal) {
                // Hapus entries dan ledger (cascade delete jika diatur di model)
                $journal->entries()->delete();
                // Jika tidak cascade: Ledger::whereIn('journal_entry_id', $journal->entries->pluck('id'))->delete();
                $journal->delete();
            });
        } catch (\Exception $e) {
            return back()->withErrors('Terjadi kesalahan saat menghapus jurnal: ' . $e->getMessage());
        }

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dihapus.');
    }

    // Jurnal penyesuaian bisa dibuat method dan view terpisah jika berbeda perlakuan
    public function adjustment()
    {
        // logika serupa dengan index, bisa difilter
        $journals = Journal::where('is_adjustment', true)->paginate(10);
        return view('journals.adjustment', compact('journals'));
    }
}