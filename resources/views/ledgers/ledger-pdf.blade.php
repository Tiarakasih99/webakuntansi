<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BUKU BESAR</title>

    <style>
        body {
            background: #f5f6fa;
        }

        .report-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            max-width: 850px;
            margin: auto;
            font-family: "Times New Roman", serif;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
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

        .account-title {
            font-weight: bold;
            font-size: 15px;
            margin-top: 30px;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            font-size: 15px;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            font-weight: bold;
            border-bottom: 2px solid black;
            padding: 8px;
            text-align: center;
        }

        td {
            padding: 6px 6px;
        }

        .text-end {
            text-align: right;
        }

        .saldo {
            font-weight: bold;
        }

        .no-entry {
            text-align: center;
            font-style: italic;
            padding: 10px;
        }
    </style>
</head>

<body>

<div class="report-container">

    <div class="report-title">Adésté & Co.</div>
    <div class="report-title">BUKU BESAR</div>

    @if($startDate && $endDate)
        <div class="report-subtitle">
            Periode {{ date('d M Y', strtotime($startDate)) }}
            s/d {{ date('d M Y', strtotime($endDate)) }}
        </div>
    @endif

    @foreach($accounts as $account)

        <div class="account-title">
            {{ $account['name'] }} ({{ $account['code'] }})
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:25%">Tanggal</th>
                    <th style="width:25%">Debit (Rp)</th>
                    <th style="width:25%">Kredit (Rp)</th>
                    <th style="width:25%">Saldo (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($account['entries'] as $entry)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($entry['date'])->format('d M Y') }}
                        </td>
                        <td class="text-end">
                            {{ !empty($entry['debit']) ? number_format($entry['debit'],2,',','.') : '-' }}
                        </td>
                        <td class="text-end">
                            {{ !empty($entry['credit']) ? number_format($entry['credit'],2,',','.') : '-' }}
                        </td>
                        <td class="text-end saldo">
                            {{ isset($entry['balance']) ? number_format($entry['balance'],2,',','.') : '0,00' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="no-entry">
                            Tidak ada transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @endforeach

</div>

</body>
</html>
