<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Posisi Keuangan</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
        }

        .report-container {
            width: 100%;
        }

        .report-title {
            color: #570f8fff;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 0px;
        }

        .report-subtitle {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            border-bottom: 1px solid black;
            padding: 6px 4px;
            font-weight: bold;
        }

        td {
            padding: 4px 4px;
        }

        .indent { padding-left: 15px; }

        .total {
            border-top: 1px solid black;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="report-container">

    <div class="report-title">Adésté & Co.</div>
    <div class="report-title">LAPORAN POSISI KEUANGAN</div>
    <div class="report-subtitle">Per {{ $end }}</div>

    <table>
        <tr>
            <th>Keterangan</th>
            <th style="text-align:right">Jumlah (Rp)</th>
        </tr>

        <tr><td><strong>Aset</strong></td><td></td></tr>

        @foreach ($assetDetails as $a)
        <tr>
            <td class="indent">{{ $a['name'] }}</td>
            <td style="text-align:right">{{ number_format($a['balance'],2,',','.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td class="total">Total Aset</td>
            <td class="total" style="text-align:right">
                {{ number_format($totalAssets,2,',','.') }}
            </td>
        </tr>

        <tr><td><strong>Kewajiban</strong></td><td></td></tr>

        @foreach ($liabilityDetails as $l)
        <tr>
            <td class="indent">{{ $l['name'] }}</td>
            <td style="text-align:right">{{ number_format($l['balance'],2,',','.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td class="total">Total Kewajiban</td>
            <td class="total" style="text-align:right">
                {{ number_format($totalLiabilities,2,',','.') }}
            </td>
        </tr>

        <tr><td><strong>Ekuitas</strong></td><td></td></tr>

        @foreach ($equityDetails as $e)
        <tr>
            <td class="indent">{{ $e['name'] }}</td>
            <td style="text-align:right">{{ number_format($e['balance'],2,',','.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td class="total">Total Ekuitas</td>
            <td class="total" style="text-align:right">
                {{ number_format($totalEquities,2,',','.') }}
            </td>
        </tr>

        <tr>
            <td class="total"><strong>Total Liabilitas + Ekuitas</strong></td>
            <td class="total" style="text-align:right">
                {{ number_format($totalLiabilities + $totalEquities,2,',','.') }}
            </td>
        </tr>

    </table>

</div>

</body>
</html>
