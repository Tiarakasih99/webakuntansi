<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generate(Request $request)
    {
        $category = $request->category_id;
        $start = $request->period_start;
        $end   = $request->period_end;

        if ($category === 'balance_sheet') {
            return $this->showBalanceSheet($start, $end);
        } 
        elseif ($category === 'income_statement') {
            return $this->showIncomeStatement($start, $end);
        }
        elseif ($category === 'changes_in_equity') {
            return $this->showChangesInEquity($start, $end);
        }

        return redirect()->back()->with('error', 'Tipe laporan tidak valid');
    }


    // ===============================
    // BALANCE SHEET (VIEW)
    // ===============================
    public function showBalanceSheet($start, $end)
    {
        $data = $this->balanceSheetData($start, $end);
        return view('reports.balance-sheet', $data);
    }

    // BALANCE SHEET — DATA ONLY
    private function balanceSheetData($start, $end)
    {
        // 1. Ambil modal akhir dari laporan perubahan modal
        $equityChange = $this->changesInEquityData($start, $end);
        $modalAkhir   = $equityChange['modalAkhir'];

        // 2. Ambil akun-akun sesuai kategori
        $assets = Account::whereHas('category', fn($q) => $q->where('name', 'asset'))->get();
        $liabilities = Account::whereHas('category', fn($q) => $q->where('name', 'liability'))->get();
        $equities = Account::whereHas('category', fn($q) => $q->where('name', 'equity'))->get();

        // ---- Assets ----
        $assetDetails = [];
        $totalAssets = 0;
        foreach ($assets as $acc) {
            $balance = $this->calculateAccountBalance($acc, $end);
            $assetDetails[] = ['name' => $acc->name, 'balance' => $balance];
            $totalAssets += $balance;
        }

        // ---- Liabilities ----
        $liabilityDetails = [];
        $totalLiabilities = 0;
        foreach ($liabilities as $acc) {
            $balance = $this->calculateAccountBalance($acc, $end);
            $liabilityDetails[] = ['name' => $acc->name, 'balance' => $balance];
            $totalLiabilities += $balance;
        }

        // ---- Equities ----
        $equityDetails = [];
        $totalEquities = 0;
        foreach ($equities as $acc) {
            $balance = $this->calculateAccountBalance($acc, $end);
            $equityDetails[] = ['name' => $acc->name, 'balance' => $balance];
            $totalEquities += $balance;
        }

        // ---- Inject Modal Akhir ----
        $equityDetails[] = ['name' => 'Modal Akhir', 'balance' => $modalAkhir];
        $totalEquities = $modalAkhir;

        return [
            'start'             => $start,
            'end'               => $end,
            'assetDetails'      => $assetDetails,
            'liabilityDetails'  => $liabilityDetails,
            'equityDetails'     => $equityDetails,
            'totalAssets'       => $totalAssets,
            'totalLiabilities'  => $totalLiabilities,
            'totalEquities'     => $totalEquities,
        ];
    }


    // ===============================
    // EXPORT PDF
    // ===============================
    public function exportPdf(Request $request)
    {
        $category = $request->category_id;
        $start = $request->period_start;
        $end   = $request->period_end;

        if ($category === 'balance_sheet') {
            $data = $this->balanceSheetData($start, $end);
            $pdf = Pdf::loadView('reports.pdf.balance-sheet-pdf', $data);
        } else {
            return redirect()->back()->with('error', 'Tipe laporan tidak valid');
        }

        return $pdf->download("laporan-{$category}-{$start}-{$end}.pdf");
    }


    public function showIncomeStatement($start, $end)
    {
        $data = $this->incomeStatementData($start, $end);
        return view('reports.income-statement', $data);
    }


    private function incomeStatementData($start, $end)
    {
        // 1. Pendapatan (Revenue)
        $pendapatan = Account::whereHas('category', fn($q)=> 
            $q->where('name', 'revenue')
        )->get();

        $totalPendapatan = 0;
        foreach ($pendapatan as $acc) {
            $saldo = $this->calculateAccountBalance($acc, $end);
            $totalPendapatan += $saldo;
        }

        // 2. HPP (COGS)
        $hpp = Account::whereHas('category', fn($q)=> 
            $q->where('name', 'hpp')
        )->get();

        $totalHPP = 0;
        foreach ($hpp as $acc) {
            $saldo = $this->calculateAccountBalance($acc, $end);
            $totalHPP += $saldo;
        }

        // 3. Laba Kotor
        $labaKotor = $totalPendapatan - $totalHPP;

        // 4. Beban Operasional
        $beban = Account::whereHas('category', fn($q)=> 
            $q->where('name', 'expense')
        )->get();

        $daftarBeban = [];
        $totalBeban = 0;

        foreach ($beban as $acc) {
            $saldo = $this->calculateAccountBalance($acc, $end);
            $daftarBeban[] = [
                'name'  => $acc->name,
                'total' => $saldo
            ];
            $totalBeban += $saldo;
        }

        // Jika kamu ingin total operasional = total beban (bisa diganti jika ada kategori lain)
        $totalOperasional = $totalBeban;

        // 5. Pendapatan Non Operasional
        $pendNonOp = Account::whereHas('category', fn($q)=> 
            $q->where('name', 'pendapatan_non_operasional')
        )->get()
        ->sum(fn($acc)=> $this->calculateAccountBalance($acc, $end));

        // 6. Beban Non Operasional
        $bebanNonOp = Account::whereHas('category', fn($q)=> 
            $q->where('name', 'beban_non_operasional')
        )->get()
        ->sum(fn($acc)=> $this->calculateAccountBalance($acc, $end));

        // 7. Laba Bersih
        $labaBersih = $labaKotor - $totalOperasional + $pendNonOp - $bebanNonOp;

        return [
            'start' => $start,
            'end'   => $end,

            'totalPendapatan' => $totalPendapatan,
            'totalHPP'        => $totalHPP,
            'labaKotor'       => $labaKotor,

            'daftarBeban'     => $daftarBeban,
            'totalBeban'      => $totalBeban,
            'totalOperasional'=> $totalOperasional,

            'pendNonOp'       => $pendNonOp,
            'bebanNonOp'      => $bebanNonOp,

            'labaBersih'      => $labaBersih,
        ];
    }

    public function exportIncomePdf(Request $request)
    {
        $start = $request->period_start;
        $end   = $request->period_end;

        $data = $this->incomeStatementData($start, $end);

        $pdf = Pdf::loadView('reports.pdf.income-statement-pdf', $data);

        return $pdf->download("income-statement-{$start}-{$end}.pdf");
    }


    public function showChangesInEquity($start, $end)
    {
        $data = $this->changesInEquityData($start, $end);
        return view('reports.changes-in-equity', $data);
    }

    private function changesInEquityData($start, $end)
    {
        // ---- 1. Hitung Modal Awal (saldo equity sebelum periode mulai) ----
        $modalAkun = Account::whereHas('category', fn($q) =>
            $q->where('code','3100')
        )->get();

        $modalAwal = 0;
        foreach ($modalAkun as $acc) {
            $modalAwal += $this->calculateAccountBalance($acc, $end);
        }

        // ---- 2. Hitung Laba Bersih dari Income Statement ----
        $incomeData = $this->incomeStatementData($start, $end);
        $labaBersih = $incomeData['labaBersih'];

        // ---- 3. Prive (penarikan pemilik) ----
        $prive = Account::whereHas('category', fn($q) =>
            $q->where('code','3102')
        )->get()
        ->sum(fn($acc) => abs($this->calculateAccountBalance($acc, $end)));


        // ---- 4. Investasi Tambahan Pemilik ----
        $investasiTambah = Account::whereHas('category', fn($q) =>
            $q->where('name', 'capital_injection')
        )->get()
        ->sum(fn($acc) => $this->calculateAccountBalance($acc, $end));

        // ---- 5. Hitung Modal Akhir ----
        $modalAkhir = $modalAwal + $labaBersih - $prive + $investasiTambah;

        return [
            'start'           => $start,
            'end'             => $end,

            'modalAwal'       => $modalAwal,
            'labaBersih'      => $labaBersih,
            'Prive'           => $prive,
            'investasiTambah' => $investasiTambah,

            'modalAkhir'      => $modalAkhir,
        ];
    }

    public function exportEquityPdf(Request $request)
    {
        $start = $request->period_start;
        $end   = $request->period_end;

        $data = $this->changesInEquityData($start, $end);
        
        $pdf = Pdf::loadView('reports.pdf.changes-in-equity-pdf', $data);

        return $pdf->download("changes-in-equity-{$start}-{$end}.pdf");
    }





    // ===============================
    // HITUNG SALDO AKUN
    // ===============================
    private function calculateAccountBalance($account, $endDate)
    {
        $entries = $account->journalEntries()
            ->whereHas('journal', fn($q) => $q->where('date', '<=', $endDate))
            ->get();

        $normal = strtolower($account->category->normal_balance);

        $balance = 0;

        foreach ($entries as $entry) {
            if ($normal === 'debit') {
                $balance += ($entry->debit - $entry->credit);
            } else {
                $balance += ($entry->credit - $entry->debit);
            }
        }

        return $balance;
    }
}
