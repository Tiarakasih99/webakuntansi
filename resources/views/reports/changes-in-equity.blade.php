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
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
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
    }

    .report-table th {
        font-weight: bold;
        border-bottom: 2px solid black;
        padding-bottom: 8px;
    }

    .report-table td {
        padding: 6px 0;
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

    <div class="report-title">LAPORAN PERUBAHAN MODAL</div>
    <div class="report-subtitle">
        Periode: {{ $start }} s/d {{ $end }}
    </div>

    <table class="report-table">
        <tr>
            <th>Keterangan</th>
            <th class="text-end">Jumlah (Rp)</th>
        </tr>

        <tr>
            <td><strong>Ekuitas Awal</strong></td>
            <td class="text-end">{{ number_format($initialEquity, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td><strong>Laba Bersih</strong></td>
            <td class="text-end">{{ number_format($netIncome, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td><strong>Prive / Penarikan Pemilik</strong></td>
            <td class="text-end">{{ number_format($ownerDraw ?? 0, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="total"><strong>Ekuitas Akhir</strong></td>
            <td class="total text-end">{{ number_format($finalEquity, 2, ',', '.') }}</td>
        </tr>

        <tr>
            <td><strong>Perubahan Modal</strong></td>
            <td class="text-end">{{ number_format($changes, 2, ',', '.') }}</td>
        </tr>

    </table>

</div>
@endsection
