<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Laba Rugi</title>
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
        
        table.report-table {
            width: 100%;
            font-size: 15px;
            border-collapse: collapse;
        }
        
        .report-table td {
            padding: 7px 0;
        }

        .indent {
            padding-left: 25px;
        }
        
        .total-line {
            border-top: 1px solid #000;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            padding-top: 10px;
        }
        
        .text-end {
            text-align: right;
        }
    </style>
</head>
<body>
    <div  class="report-container">
        <div class="report-title">Adésté & Co.</div>
        <div class="report-title">Laporan Laba/Rugi (Standar)</div>
        <div class="report-subtitle">
            Periode: {{ $start }} s/d {{ $end }}
        </div>
        <table class="report-table">

        {{-- PENDAPATAN --}}
        <tr>
            <td class="section-title">PENDAPATAN</td>
            <td></td>
        </tr>
        <tr>
            <td class="indent">Pendapatan</td>
            <td class="text-end">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="indent total-line">Jumlah Pendapatan</td>
            <td class="text-end total-line">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>

        {{-- HPP --}}
        <tr>
            <td class="section-title">BEBAN POKOK PENJUALAN</td>
            <td></td>
        </tr>
        <tr>
            <td class="indent">Jumlah Beban Pokok Penjualan</td>
            <td class="text-end">{{ number_format($totalHPP, 0, ',', '.') }}</td>
        </tr>

        {{-- LABA KOTOR --}}
        <tr>
            <td class="indent section-title">LABA KOTOR</td>
            <td class="text-end">{{ number_format($labaKotor, 0, ',', '.') }}</td>
        </tr>

        {{-- BEBAN OPERASIONAL --}}
        <tr>
            <td class="section-title">BEBAN OPERASIONAL</td>
            <td></td>
        </tr>
        <tr>
            <td class="section-title">BEBAN-BEBAN</td>
            <td></td>
        </tr>

        @foreach ($daftarBeban as $beban)
        <tr>
            <td class="indent">{{ $beban['name'] }}</td>
            <td class="text-end">{{ number_format($beban['total'], 0, ',', '.') }}</td>
        </tr>
        @endforeach

        <tr>
            <td class="indent total-line">Total Beban</td>
            <td class="text-end total-line">{{ number_format($totalBeban, 0, ',', '.') }}</td>
        </tr>


        @if(isset($totalOperasional) && $totalOperasional > 0)
        <tr>
            <td class="indent">Total Beban Operasional</td>
            <td class="text-end">{{ number_format($totalOperasional, 0, ',', '.') }}</td>
        </tr>
        @endif

        {{-- PENDAPATAN & BEBAN NON OPERASIONAL --}}
        <tr>
            <td class="section-title">PENDAPATAN DAN BEBAN NON OPERASIONAL</td>
            <td></td>
        </tr>
        <tr>
            <td class="indent">Pendapatan Non Operasional</td>
            <td class="text-end">{{ number_format($pendNonOp, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="indent">Beban Non Operasional</td>
            <td class="text-end">{{ number_format($bebanNonOp, 0, ',', '.') }}</td>
        </tr>

        {{-- LABA BERSIH --}}
        <tr>
            <td class="section-title total-line">LABA BERSIH</td>
            <td class="text-end total-line">
                {{ number_format($labaBersih, 0, ',', '.') }}
            </td>
        </tr>

    </table>
</body>
</html>