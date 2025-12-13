

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Jurnal Umum Detail</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 13px;
            background: #fff;
            color: #333;
        }

        .report-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px 40px;
            background: #fff;
        }

        /* HEADER */
        .company-name {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #570f8f; /* ungu */
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .report-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 2px;
            color: #570f8f; /* ungu */
        }

        .report-subtitle {
            text-align: center;
            font-size: 14px;
            margin-bottom: 30px;
            color: #555;
        }

        /* JOURNAL BOX */
        .journal-box {
            margin-bottom: 30px;
        }

        .journal-header {
            margin-bottom: 12px;
            font-weight: bold;
            color: #333;
        }

        /* TABLE STYLE MINIMALIS */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            font-size: 13px;
            background: #f8f7ff; /* lavender soft */
            border-radius: 8px;
            overflow: hidden;
        }

        thead tr {
            background: #e6e0f8; /* lavender header */
            color: #333;
            text-align: left;
            font-weight: bold;
        }

        th, td {
            padding: 10px 12px;
        }

        tbody tr:nth-child(even) {
            background: #f4f2ff; /* alternating soft lavender */
        }

        .text-right {
            text-align: right;
        }

        .indent {
            padding-left: 18px;
        }

        .total-row {
            background: #dcd4f8; /* slightly darker lavender */
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: right;
            color: #555;
        }

    </style>
</head>
<body>

<div class="report-container">

    <!-- HEADER -->
    <div class="company-name">Adésté & Co.</div>
    <div class="report-title">LAPORAN JURNAL UMUM (DETAIL)</div>
    <div class="report-subtitle">Periode 31 Januari 2025</div>

    <!-- CONTENT -->
    @foreach($journals as $journal)
        <div class="journal-box">
            <div class="journal-header">
                No Transaksi : {{ $journal->transaction_number }} <br>
                Tanggal : {{ $journal->date }} <br>
                Deskripsi : {{ $journal->description ?? '-' }}
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Akun</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($journal->entries as $entry)
                    <tr>
                        <td class="indent">
                            {{ $entry->account->code }} - {{ $entry->account->name }}
                        </td>
                        <td class="text-right">
                            {{ number_format($entry->debit, 2, ',', '.') }}
                        </td>
                        <td class="text-right">
                            {{ number_format($entry->credit, 2, ',', '.') }}
                        </td>
                        <td>{{ $entry->description ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td>Total</td>
                        <td class="text-right">{{ number_format($journal->entries->sum('debit'), 2, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($journal->entries->sum('credit'), 2, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endforeach

    <!-- FOOTER -->
    <div class="footer">
        Dicetak pada {{ now()->format('d M Y H:i') }}
    </div>

</div>

</body>
</html>