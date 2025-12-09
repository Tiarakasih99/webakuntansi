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

    .ledger-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 0;
        margin-bottom: 35px;
        border: 1px solid #e4e4e4;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: 0.2s;
    }

    .ledger-card:hover {
        transform: scale(1.003);
        box-shadow: 0 4px 14px rgba(0,0,0,0.07);
    }

    /* ====== HEADER ====== */
    .ledger-header {
        padding: 18px 25px;
        background: linear-gradient(135deg, #3246D3, #6676F5);
        color: white;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: .4px;
    }

    .ledger-header small {
        display: block;
        font-size: 13px;
        opacity: 0.9;
        margin-top: 3px;
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

    .ledger-table tbody tr:hover {
        background: #fafafa;
    }

    .text-end {
        text-align: right;
    }

    .no-entry {
        text-align: center;
        padding: 18px;
        color: #888;
        font-style: italic;
    }

    .saldo-bold {
        font-weight: 700;
        color: #2b2f42;
    }
</style>

<div class="ledger-wrapper">
    <h1 class="ledger-title">Buku Besar (General Ledger)</h1>

    <!-- FORM FILTER TANGGAL -->
    <form action="{{ route('ledgers.index') }}" method="GET" style="margin-bottom: 25px;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div>
                <label>Start Date:</label>
                <input type="date" name="start_date" value="{{ $startDate ?? '' }}">
            </div>
            <div>
                <label>End Date:</label>
                <input type="date" name="end_date" value="{{ $endDate ?? '' }}">
            </div>
            <button type="submit" style="padding: 5px 12px; background-color:#3246D3; color:white; border:none; border-radius:6px;">Filter</button>
            <a href="{{ route('ledgers.index') }}" style="padding: 5px 12px; background:#888; color:white; border-radius:6px; text-decoration:none;">Reset</a>
        </div>
    </form>

    @foreach($accounts as $account)
    <div class="ledger-card">

        <!-- HEADER -->
        <div class="ledger-header">
            {{ $account['name'] }}
            <small>Kode Akun: {{ $account['code'] }}</small>
        </div>

        <!-- TABLE -->
        <table class="ledger-table">
            <thead>
                <tr>
                    <th style="width: 25%">Tanggal</th>
                    <th style="width: 25%">Debit</th>
                    <th style="width: 25%">Kredit</th>
                    <th style="width: 25%">Saldo</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($account['entries'] as $entry)
                    <tr>
                        <td class="text-center">{{ \Carbon\Carbon::parse($entry['date'])->format('d M Y') }}</td>
                        <td class="text-end">{{ $entry['debit'] ? number_format($entry['debit'], 2, ',', '.') : '-' }}</td>
                        <td class="text-end">{{ $entry['credit'] ? number_format($entry['credit'], 2, ',', '.') : '-' }}</td>
                        <td class="text-end saldo-bold">{{ number_format($entry['balance'], 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="no-entry">Belum ada transaksi pada akun ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endforeach

</div>


@endsection
