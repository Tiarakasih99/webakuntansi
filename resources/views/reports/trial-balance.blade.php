@extends('layouts.main')

@section('title', 'Neraca Saldo')

@section('content')

<link rel="stylesheet" href="{{ asset('css/neraca.css') }}">

<div class="neraca-wrapper">

    <h3 class="neraca-title">Neraca Saldo</h3>

    {{-- FILTER --}}
    <form method="GET" class="neraca-filter">
        <div class="filter-grid">

            <div>
                <label>Start Date:</label>
                <input type="date" name="start_date" value="{{ $startDate }}">
            </div>

            <div>
                <label>End Date:</label>
                <input type="date" name="end_date" value="{{ $endDate }}">
            </div>

            <button type="submit" class="filter-btn">
                Filter
            </button>

            {{-- EXPORT PDF --}}
            <a href="{{ route('trial-balance.export-pdf', [
                'start_date' => $startDate,
                'end_date'   => $endDate
            ]) }}"
            class="export-btn">
                Export PDF
            </a>

        </div>
    </form>

    {{-- TABLE --}}
    <div class="neraca-card">
        <table class="neraca-table">
            <thead>
                <tr>
                    <th>Kode Akun</th>
                    <th>Akun</th>
                    <th class="text-end">Debit</th>
                    <th class="text-end">Kredit</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $row)
                <tr>
                    <td>{{ $row['code'] }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td class="text-end">{{ number_format($row['debit'], 2) }}</td>
                    <td class="text-end">{{ number_format($row['credit'], 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse

                <tr class="neraca-total">
                    <td>Total</td>
                    <td></td>
                    <td class="text-end">{{ number_format($totalDebit, 2) }}</td>
                    <td class="text-end">{{ number_format($totalCredit, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- STYLE --}}
<style>
/* ====== WRAPPER ====== */
.neraca-wrapper {
    max-width: 900px;
    margin: auto;
    font-family: "Inter", "Segoe UI", sans-serif;
    padding: 30px;
}

.neraca-title {
    font-size: 28px;
    font-weight: 700;
    color: #2b2f42;
    margin-bottom: 25px;
}

/* ====== FILTER ====== */
.filter-grid {
    display: flex;
    gap: 20px;
    align-items: end;
    flex-wrap: wrap;
}

.filter-grid label {
    font-size: 13px;
    font-weight: 500;
}

.filter-grid input[type="date"] {
    padding: 8px 12px;
}

.filter-btn {
    background: linear-gradient(90deg, #5d53a6, #8fa1e0);
    border: none;
    border-radius: 6px;
    padding: 8px 40px;
    color: #fff;
    cursor: pointer;
    font-weight: 500;
}

.filter-btn:hover {
    opacity: 0.9;
}

/* ====== EXPORT ====== */
.export-btn {
    background: #e74c3c;
    color: #fff;
    padding: 8px 30px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
}

.export-btn:hover {
    background: #c0392b;
}

/* ====== CARD ====== */
.neraca-card {
    margin-top: 25px;
    background: #ffffff;
    border-radius: 12px;
    padding: 0;
    border: 1px solid #e4e4e4;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* ====== TABLE ====== */
.neraca-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
}

.neraca-table thead th {
    background: #f2f4f7;
    padding: 14px;
    font-weight: 600;
    border-bottom: 2px solid #d2d6dc;
}

.neraca-table tbody td {
    padding: 12px 14px;
    border-bottom: 1px solid #ececec;
}

.neraca-table tbody tr:hover {
    background: #fafafa;
}

/* ====== TOTAL ====== */
.neraca-total {
    background: #e9edf5;
    font-weight: 700;
}

/* ====== UTILITY ====== */
.text-end {
    text-align: right;
}
</style>

@endsection
