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
            'type' => 'required|in:balance_sheet,income_statement,changes_in_equity',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
        ]);

        $start = $request->period_start;
        $end = $request->period_end;
        $type = $request->type;

        if ($type == 'balance_sheet') {
            return $this->balanceSheet($start, $end);
        } elseif ($type == 'income_statement') {
            return $this->incomeStatement($start, $end);
        } elseif ($type == 'changes_in_equity') {
            return $this->changesInEquity($start, $end);
        }
    }

    // Laporan Posisi Keuangan (Balance Sheet)
    private function balanceSheet($start, $end)
    {
        // Hitung saldo akhir untuk aset, liability, equity hingga akhir periode
        $assets = Account::where('type', 'asset')->get();
        $liabilities = Account::where('type', 'liability')->get();
        $equities = Account::where('type', 'equity')->get();

        $totalAssets = 0;
        $totalLiabilities = 0;
        $totalEquities = 0;

        foreach ($assets as $account) {
            $balance = $this->getAccountBalance($account, $end);
            $totalAssets += $balance;
        }

        foreach ($liabilities as $account) {
            $balance = $this->getAccountBalance($account, $end);
            $totalLiabilities += $balance;
        }

        foreach ($equities as $account) {
            $balance = $this->getAccountBalance($account, $end);
            $totalEquities += $balance;
        }

        return view('reports.balance-sheet', compact('assets', 'liabilities', 'equities', 'totalAssets', 'totalLiabilities', 'totalEquities', 'start', 'end'));
    }

    // Laporan Laba Rugi (Income Statement)
    private function incomeStatement($start, $end)
    {
        // Hitung total revenue dan expense dalam periode
        $revenues = Account::where('type', 'revenue')->get();
        $expenses = Account::where('type', 'expense')->get();

        $totalRevenue = 0;
        $totalExpense = 0;

        foreach ($revenues as $account) {
            $totalRevenue += $this->getAccountMovement($account, $start, $end, 'credit'); // Revenue biasanya credit
        }

        foreach ($expenses as $account) {
            $totalExpense += $this->getAccountMovement($account, $start, $end, 'debit'); // Expense biasanya debit
        }

        $netIncome = $totalRevenue - $totalExpense;

        return view('reports.income-statement', compact('revenues', 'expenses', 'totalRevenue', 'totalExpense', 'netIncome', 'start', 'end'));
    }

    // Laporan Perubahan Modal (Changes in Equity)
    private function changesInEquity($start, $end)
    {
        // Hitung perubahan equity dalam periode, termasuk laba bersih
        $equities = Account::where('type', 'equity')->get();
        $initialEquity = 0;
        $finalEquity = 0;

        foreach ($equities as $account) {
            $initialEquity += $this->getAccountBalance($account, $start . ' 00:00:00'); // Saldo awal periode
            $finalEquity += $this->getAccountBalance($account, $end);
        }

        // Tambahkan laba bersih dari income statement
        $netIncome = $this->calculateNetIncome($start, $end);
        $finalEquity += $netIncome;

        $changes = $finalEquity - $initialEquity;

        return view('reports.changes-in-equity', compact('equities', 'initialEquity', 'finalEquity', 'netIncome', 'changes', 'start', 'end'));
    }

    // Helper: Hitung saldo akun hingga tanggal tertentu
    private function getAccountBalance($account, $date)
    {
        return $account->ledger()->where('date', '<=', $date)->orderBy('date', 'desc')->value('balance') ?? $account->balance ?? 0;
    }

    // Helper: Hitung pergerakan akun dalam periode (debit atau credit)
    private function getAccountMovement($account, $start, $end, $type)
    {
        return $account->journalEntries()->whereHas('journal', function ($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        })->sum($type);
    }

    // Helper: Hitung laba bersih (untuk changes in equity)
    private function calculateNetIncome($start, $end)
    {
        $totalRevenue = Account::where('type', 'revenue')->get()->sum(function ($account) use ($start, $end) {
            return $this->getAccountMovement($account, $start, $end, 'credit');
        });

        $totalExpense = Account::where('type', 'expense')->get()->sum(function ($account) use ($start, $end) {
            return $this->getAccountMovement($account, $start, $end, 'debit');
        });

        return $totalRevenue - $totalExpense;
    }

    // Halaman neraca saldo (trial balance) - tetap ada
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

        $totalDebit = array_sum(array_column($data, 'debit'));
        $totalCredit = array_sum(array_column($data, 'credit'));

        return view('reports.trial-balance', compact('data', 'totalDebit', 'totalCredit'));
    }
}