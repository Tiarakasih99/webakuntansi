@extends('layouts.main')

@section('title', 'Buku Besar')

@section('content')

<style>
    /* ====== STYLE UMUM ====== */
    .ledger-wrapper {
        max-width: 1000px;
        margin: auto;
        font-family: "Inter", "Segoe UI", sans-serif;
        padding: 30px;
    }

    .ledger-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 25px;
        color: #2b2f42;
    }

    /* ====== FILTER BAR ====== */
    .filter-grid {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        font-size: 14px;
    }

    .filter-group input[type="date"] {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        margin-left: auto;
    }

    .btn {
        height: 38px;
        padding: 0 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        border: none;
        cursor: pointer;
        color: #fff;
        white-space: nowrap;
    }

    .btn-filter {
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);
    }

    .btn-reset {
        background: #888;
    }

    .btn-pdf {
        background: #e74c3c;
    }

    /* ====== CARD ====== */
    .ledger-card {
        background: #ffffff;
        border-radius: 12px;
        margin-bottom: 35px;
        border: 1px solid #e4e4e4;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .ledger-header {
        padding: 18px 25px;
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);
        color: white;
        font-size: 18px;
        font-weight: 600;
    }

    .ledger-header small {
        display: block;
        font-size: 13px;
        opacity: 0.9;
    }

    /* ====== TABEL ====== */
    .ledger-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        color: #333;
    }

    .ledger-table thead th {
        background: #f2f4f7;
        padding: 14px 12px;
        font-weight: 600;
        border-bottom: 2px solid #d2d6dc;
        text-align: center;
    }

    .ledger-table tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid #ececec;
    }

    .text-end {
        text-align: right;
    }

    .saldo-bold {
        font-weight: 700;
    }

    .no-entry {
        text-align: center;
        padding: 18px;
        color: #888;
        font-style: italic;
    }
</style>

<div class="ledger-wrapper">
    <h1 class="ledger-title">Buku Besar (General Ledger)</h1>

    <!-- FILTER -->
    <form action="{{ route('ledgers.index') }}" method="GET" style="margin-bottom: 25px;">
        <div class="filter-grid">

            <div class="filter-group">
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ $startDate ?? '' }}">
            </div>

            <div class="filter-group">
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ $endDate ?? '' }}">
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-filter">Filter</button>

                <a href="{{ route('ledgers.index') }}" class="btn btn-reset">
                    Reset
                </a>

                <a href="{{ route('ledgers.export-pdf', [
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]) }}" class="btn btn-pdf">
                    Export PDF
                </a>
            </div>

        </div>
    </form>

    @foreach($accounts as $account)
        <div class="ledger-card">

            <div class="ledger-header">
                {{ $account['name'] }}
                <small>Kode Akun: {{ $account['code'] }}</small>
            </div>

            <table class="ledger-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($account['entries'] as $entry)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($entry['date'])->format('d M Y') }}</td>
                            <td class="text-end">
                                {{ $entry['debit'] ? number_format($entry['debit'],2,',','.') : '-' }}
                            </td>
                            <td class="text-end">
                                {{ $entry['credit'] ? number_format($entry['credit'],2,',','.') : '-' }}
                            </td>
                            <td class="text-end saldo-bold">
                                {{ number_format($entry['balance'],2,',','.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="no-entry">
                                Belum ada transaksi pada akun ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    @endforeach
</div>

@endsection
