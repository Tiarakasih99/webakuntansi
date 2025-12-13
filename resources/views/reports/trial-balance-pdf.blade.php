<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Neraca Saldo</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            color: #000;
        }

        .report-container {
            background: #fff;
            padding: 40px;
            max-width: 850px;
            margin: auto;
        }

        .report-title {
            color: #570f8f;
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

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        th {
            font-weight: bold;
            border-bottom: 2px solid black;
            padding: 8px;
            text-align: left;
        }

        th.text-end {
            text-align: right;
        }

        td {
            padding: 6px 6px;
        }

        .text-end {
            text-align: right;
        }

        .total {
            border-top: 1px solid black;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="report-container">

    <div class="report-title">Adésté & Co.</div>
    <div class="report-title">NERACA SALDO</div>

    @if($startDate && $endDate)
        <div class="report-subtitle">
            Periode {{ date('d M Y', strtotime($startDate)) }}
            s/d {{ date('d M Y', strtotime($endDate)) }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width:15%">Kode Akun</th>
                <th style="width:45%">Nama Akun</th>
                <th class="text-end" style="width:20%">Debit (Rp)</th>
                <th class="text-end" style="width:20%">Kredit (Rp)</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row['code'] }}</td>
                <td>{{ $row['name'] }}</td>
                <td class="text-end">
                    {{ number_format($row['debit'], 2, ',', '.') }}
                </td>
                <td class="text-end">
                    {{ number_format($row['credit'], 2, ',', '.') }}
                </td>
            </tr>
            @endforeach

            <tr>
                <td colspan="2" class="total">TOTAL</td>
                <td class="total text-end">
                    {{ number_format($totalDebit, 2, ',', '.') }}
                </td>
                <td class="total text-end">
                    {{ number_format($totalCredit, 2, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

</div>

</body>
</html>
