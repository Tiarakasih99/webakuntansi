<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perubahan Modal</title>
    <style>
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
</head>
<body>
    <div class="report-title">Adeste&Co</div>
    <div class="report-title">LAPORAN PERUBAHAN MODAL</div>
    <div class="report-subtitle">Periode: {{ $start }} s/d {{ $end }}</div>

    <table class="report-table">

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
            <td class="text-end">{{ number_format($Prive ?? 0, 2, ',', '.') }}</td>
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
</body>
</html>