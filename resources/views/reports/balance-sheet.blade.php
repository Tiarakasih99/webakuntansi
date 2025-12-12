@extends('layouts.main')

@section('content')
<style>
    .report-container {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        max-width: 850px;
        margin: auto;
        font-family: "Times New Roman", serif;
    }

    .report-title {
        color: #570f8fff;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .report-subtitle {
        text-align: center;
        font-size: 15px;
        margin-bottom: 25px;
    }

    .report-table {
        width: 100%;
        font-size: 15px;
    }

    .report-table th {
        font-weight: bold;
        border-bottom: 2px solid black;
        padding-bottom: 8px;
    }

    .report-table td {
        padding: 7px 0;
    }

    .indent {
        padding-left: 25px;
    }

    .total {
        font-weight: bold;
        border-top: 2px solid black;
        padding-top: 8px;
    }
</style>

<div class="report-container">

    <form action="{{ route('reports.exportPdf') }}" method="POST" class="text-end mb-3">
        @csrf
        <input type="hidden" name="category_id" value="balance_sheet">
        <input type="hidden" name="period_start" value="{{ $start }}">
        <input type="hidden" name="period_end" value="{{ $end }}">
        <button class="btn btn-danger">Export PDF</button>
    </form>

    <div class="report-title">Adésté & Co.</div>
    <div class="report-title">LAPORAN POSISI KEUANGAN</div>
    <div class="report-subtitle">Per {{ $end }}</div>

    <table class="report-table">
        <tr>
            <th>Keterangan</th>
            <th class="text-end">Jumlah (Rp)</th>
        </tr>

        <tr>
            <td><strong>Aset</strong></td><td></td>
        </tr>

        @foreach ($assetDetails as $a)
        <tr>
            <td class="indent">{{ $a['name'] }}</td>
            <td class="text-end">{{ number_format($a['balance'], 2, ',', '.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td class="total">Total Aset</td>
            <td class="total text-end">{{ number_format($totalAssets, 2, ',', '.') }}</td>
        </tr>

        <tr><td><strong>Kewajiban</strong></td><td></td></tr>

        @foreach ($liabilityDetails as $l)
        <tr>
            <td class="indent">{{ $l['name'] }}</td>
            <td class="text-end">{{ number_format($l['balance'], 2, ',', '.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td class="total">Total Liabilitas</td>
            <td class="total text-end">{{ number_format($totalLiabilities, 2, ',', '.') }}</td>
        </tr>

        <tr><td><strong>Ekuitas</strong></td><td></td></tr>

        @foreach ($equityDetails as $e)
        <tr>
            <td class="indent">{{ $e['name'] }}</td>
            <td class="text-end">{{ number_format($e['balance'], 2, ',', '.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td class="total">Total Ekuitas</td>
            <td class="total text-end">{{ number_format($totalEquities, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="total"><strong>Total Liabilitas + Ekuitas</strong></td>
            <td class="total text-end">{{ number_format($totalLiabilities + $totalEquities, 2, ',', '.') }}</td>
        </tr>

    </table>

</div>
@endsection