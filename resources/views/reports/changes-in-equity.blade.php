@extends('layouts.main')

@section('content')
<style>
    .report-container {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        max-width: 800px;
        margin: auto;
        font-family: "Times New Roman", serif;
    }

    .report-title {
        color: #b30000;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 4px;
        text-transform: uppercase;
    }

    .report-subtitle {
        text-align: center;
        font-size: 16px;
        margin-bottom: 25px;
    }

    .report-table {
        width: 100%;
        font-size: 16px;
        border-collapse: collapse;
    }

    .report-table th {
        font-weight: bold;
        padding: 8px 0;
        border-bottom: 2px solid #000;
        text-align: left;
    }

    .report-table td {
        padding: 8px 0;
    }

    .text-end {
        text-align: right;
    }

    .section-title {
        font-weight: bold;
    }

    .total-row {
        font-weight: bold;
        border-top: 2px solid #000;
        padding-top: 10px;
    }
</style>

<div class="report-container">
    
    <form action="{{ route('reports.exportEquityPdf') }}" method="POST" class="text-end mb-3">
    @csrf
    <input type="hidden" name="period_start" value="{{ $start }}">
    <input type="hidden" name="period_end" value="{{ $end }}">
    <button class="btn btn-danger">Export PDF</button>
    </form>

    <div class="report-title">Adeste&Co</div>
    <div class="report-title">LAPORAN PERUBAHAN MODAL</div>
    <div class="report-subtitle">Periode: {{ $start }} s/d {{ $end }}</div>

    <table class="report-table">
        <tr>
            <th>Keterangan</th>
            <th class="text-end">Jumlah (Rp)</th>
        </tr>

        <tr>
            <td class="section-title">Modal Awal</td>
            <td class="text-end">{{ number_format($modalAwal, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="section-title">Laba Bersih</td>
            <td class="text-end">{{ number_format($labaBersih, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="section-title">Prive / Penarikan Pemilik</td>
            <td class="text-end">{{ number_format($Prive, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="total-row">Modal Akhir</td>
            <td class="total-row text-end">{{ number_format($modalAkhir, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="section-title">Perubahan Modal</td>
            <td class="text-end">{{ number_format($modalAkhir, 2, ',', '.') }}</td>
        </tr>
    </table>
</div>
@endsection
