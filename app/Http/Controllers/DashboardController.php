<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Journal;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ==============================
        // 1. TOTAL ASSET / LIABILITY / EQUITY
        // ==============================
        // Note: asumsi: AccountCategory->type or ->name menyatakan type seperti 'Asset','Liability','Equity','Revenue','Expense'
        $asset = Account::whereHas('category', fn($q) => $q->where('name', 'Asset')->orWhere('name','asset'))
            ->withSum('journalEntries as balance', DB::raw('debit - credit'))
            ->get()
            ->sum('balance');

        $liability = Account::whereHas('category', fn($q) => $q->where('name', 'Liability')->orWhere('name','liability'))
            ->withSum('journalEntries as balance', DB::raw('credit - debit'))
            ->get()
            ->sum('balance');

        $equity = Account::whereHas('category', fn($q) => $q->where('name', 'Equity')->orWhere('name','equity'))
            ->withSum('journalEntries as balance', DB::raw('credit - debit'))
            ->get()
            ->sum('balance');

        // ==============================
        // 2. LABA/RUGI BULAN INI (profitThisMonth)
        // ==============================
        $currentMonth = date('m');
        $currentYear  = date('Y');

        $revenueThisMonth = JournalEntry::whereHas('account.category', fn($q) => $q->where('name','Revenue')->orWhere('name','revenue'))
            ->whereHas('journal', fn($q) => $q->whereMonth('date', $currentMonth)->whereYear('date', $currentYear))
            ->selectRaw('SUM(credit - debit) as total')
            ->value('total') ?? 0;

        $expenseThisMonth = JournalEntry::whereHas('account.category', fn($q) => $q->where('name','Expense')->orWhere('name','expense'))
            ->whereHas('journal', fn($q) => $q->whereMonth('date', $currentMonth)->whereYear('date', $currentYear))
            ->selectRaw('SUM(debit - credit) as total')
            ->value('total') ?? 0;

        $profitThisMonth = $revenueThisMonth - $expenseThisMonth;

        // ==============================
        // 3. PENDAPATAN PER BULAN (grafik) - gunakan 12 bulan berjalan
        // ==============================
        $incomeMonthly = JournalEntry::selectRaw('MONTH(journals.date) as month, SUM(journal_entries.credit - journal_entries.debit) as total')
            ->join('journals', 'journal_entries.journal_id', '=', 'journals.id')
            ->join('accounts', 'journal_entries.account_id', '=', 'accounts.id')
            ->join('account_categories as categories', 'accounts.category_id', '=', 'categories.id')
            ->where(function($q){
                $q->where('categories.name','Revenue')
                  ->orWhere('categories.name','revenue');
            })
            ->whereYear('journals.date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // create labels for 12 months (Jan..Dec) but fill missing months with 0
        $monthsLabels = [];
        $incomeTotals = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthsLabels[] = date('F', mktime(0,0,0,$m,1));
            $found = $incomeMonthly->firstWhere('month', $m);
            $incomeTotals[] = $found ? (float) $found->total : 0;
        }

        // ==============================
        // 4. CASHFLOW (simpel): kas masuk & kas keluar
        // Cari account yang bernama 'Kas' atau 'Cash' (fallback)
        // ==============================
        $cashAccountIds = Account::where(function($q){
                $q->where('name', 'Kas')
                  ->orWhere('name', 'kas')
                  ->orWhere('name', 'Cash')
                  ->orWhere('name', 'cash');
            })->pluck('id')->toArray();

        // Jika tidak ada account bernama Kas/Cash, jangan error: result 0
        $cashIn = 0;
        $cashOut = 0;
        if (!empty($cashAccountIds)) {
            $cashIn = JournalEntry::whereIn('account_id', $cashAccountIds)
                ->join('journals', 'journal_entries.journal_id', '=', 'journals.id')
                ->whereYear('journals.date', $currentYear)
                ->selectRaw('SUM(journal_entries.debit) as total_in')
                ->value('total_in') ?? 0;

            $cashOut = JournalEntry::whereIn('account_id', $cashAccountIds)
                ->join('journals', 'journal_entries.journal_id', '=', 'journals.id')
                ->whereYear('journals.date', $currentYear)
                ->selectRaw('SUM(journal_entries.credit) as total_out')
                ->value('total_out') ?? 0;
        }

        // ==============================
        // 5. EXPENSE BREAKDOWN (PIE)
        // ==============================
        $expenseBreakdown = JournalEntry::selectRaw("
                categories.name as category_name,
                SUM(journal_entries.debit - journal_entries.credit) as total
            ")
            ->join('accounts', 'journal_entries.account_id', '=', 'accounts.id')
            ->join('account_categories as categories', 'accounts.category_id', '=', 'categories.id')
            ->where(function($q){
                $q->where('categories.name','Expense')
                  ->orWhere('categories.name','expense');
            })
            ->groupBy('categories.name')
            ->get();

        // ==============================
        // 6. 5 JURNAL TERBARU
        // ==============================
        $recentJournals = Journal::orderBy('date', 'desc')->limit(5)->get();

        // ==============================
        // 7. KIRIM KE VIEW (sesuai blade sebelumnya)
        // ==============================
        return view('dashboard.index', [
            'asset' => (float) $asset,
            'liability' => (float) $liability,
            'equity' => (float) $equity,
            'profitThisMonth' => (float) $profitThisMonth,
            'months' => $monthsLabels,
            'incomeTotals' => $incomeTotals,
            'cashIn' => (float) $cashIn,
            'cashOut' => (float) $cashOut,
            'expenseBreakdown' => $expenseBreakdown,
            'recentJournals' => $recentJournals,
        ]);
    }
}