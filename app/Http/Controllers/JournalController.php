<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\JournalEntry;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class JournalController extends Controller
{
    /* =========================
       INDEX
    ========================= */
   public function index(Request $request)
    {
        $query = Journal::query();

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        $journals = $query->orderBy('date', 'desc')->paginate(10)->withQueryString();

        return view('journals.index', compact('journals'));
    }

    /* =========================
       CREATE
    ========================= */
    public function create()
    {
        $accounts = Account::orderBy('code')->get();
        return view('journals.create', compact('accounts'));
    }

    /* =========================
       STORE
    ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'entries' => 'required|array|min:1',
            'entries.*.account_id' => 'required',
            'entries.*.debit' => 'nullable|numeric|min:0',
            'entries.*.credit' => 'nullable|numeric|min:0',
        ]);

        $totalDebit  = collect($request->entries)->sum(fn ($e) => $e['debit'] ?? 0);
        $totalCredit = collect($request->entries)->sum(fn ($e) => $e['credit'] ?? 0);

        if ($totalDebit != $totalCredit) {
            return back()->withErrors('Total debit dan kredit harus sama!')->withInput();
        }

        DB::transaction(function () use ($request, $totalDebit) {

            $last = Journal::orderByDesc('id')->first();
            $transactionNumber = $last ? $last->transaction_number + 1 : 1;

            $journal = Journal::create([
                'transaction_number' => $transactionNumber,
                'date' => $request->date,
                'total' => $totalDebit,
                'description' => $request->description,
            ]);

            foreach ($request->entries as $entry) {
                $journal->entries()->create([
                    'account_id' => $entry['account_id'],
                    'debit' => $entry['debit'] ?? 0,
                    'credit' => $entry['credit'] ?? 0,
                    'description' => $entry['description'] ?? null,
                ]);
            }
        });

        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil disimpan.');
    }

    /* =========================
       SHOW (DETAIL)
    ========================= */
    public function show(Journal $journal)
    {
        $journal->load('entries.account');

        return view('journals.show', [
            'journal' => $journal,
            'entries' => $journal->entries
        ]);
    }

    /* =========================
       EDIT
    ========================= */
    public function edit(Journal $journal)
    {
        $journal->load('entries');
        $accounts = Account::orderBy('code')->get();

        return view('journals.edit', compact('journal', 'accounts'));
    }

    /* =========================
       UPDATE
    ========================= */
    public function update(Request $request, Journal $journal)
    {
        $request->validate([
            'date' => 'required|date',
            'entries' => 'required|array|min:1',
            'entries.*.account_id' => 'required',
            'entries.*.debit' => 'nullable|numeric|min:0',
            'entries.*.credit' => 'nullable|numeric|min:0',
        ]);

        $totalDebit  = collect($request->entries)->sum(fn ($e) => $e['debit'] ?? 0);
        $totalCredit = collect($request->entries)->sum(fn ($e) => $e['credit'] ?? 0);

        if ($totalDebit != $totalCredit) {
            return back()->withErrors('Total debit dan kredit harus sama!')->withInput();
        }

        DB::transaction(function () use ($request, $journal, $totalDebit) {

            $journal->update([
                'date' => $request->date,
                'total' => $totalDebit,
                'description' => $request->description,
            ]);

            // hapus detail lama
            $journal->entries()->delete();

            // simpan ulang detail
            foreach ($request->entries as $entry) {
                $journal->entries()->create([
                    'account_id' => $entry['account_id'],
                    'debit' => $entry['debit'] ?? 0,
                    'credit' => $entry['credit'] ?? 0,
                    'description' => $entry['description'] ?? null,
                ]);
            }
        });

        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }

    /* =========================
       DESTROY
    ========================= */
    public function destroy(Journal $journal)
    {
        DB::transaction(function () use ($journal) {
            $journal->entries()->delete();
            $journal->delete();
        });

        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil dihapus.');
    }

    /* =========================
       EXPORT PDF DETAIL
    ========================= */
    public function exportPdfDetail()
    {
        $journals = Journal::with(['entries.account'])
            ->orderBy('date', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'reports.pdf.journal-sheet-detail-pdf',
            compact('journals')
        )->setPaper('A4', 'portrait');

        return $pdf->download('jurnal-umum-detail.pdf');
    }
}