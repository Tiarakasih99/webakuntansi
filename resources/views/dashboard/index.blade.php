@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<style>
/* =====================================================
   LAVENDER THEME — REVISED, CLEAN, RESPONSIVE
===================================================== */

body {
    background: #eef0ff;
    font-family: 'Inter', sans-serif;
}

/* ===== Card Premium Glass ===== */
.card-premium {
    background: rgba(255,255,255,0.68);
    backdrop-filter: blur(10px);
    border-radius: 22px;
    padding: 26px 28px;
    border: 1px solid rgba(190, 180, 255, 0.45);
    box-shadow: 0 12px 28px rgba(150, 140, 255, 0.18);
    transition: 0.25s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.card-premium:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 36px rgba(150,140,255,0.25);
}

/* ===== Metric Labels ===== */
.metric-label {
    font-size: 13px;
    color: #6d6f9b;
    font-weight: 600;
}

/* ===== Metric Values ===== */
.metric-value {
    font-size: 20px;
    font-weight: 700;
    color: #2a2f3d;
}

/* ===== Icon Bubble ===== */
.metric-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 12px;
    font-size: 20px;
}

.icon-blue  { background: rgba(150,140,255,0.22); color:#7c72ff; }
.icon-red   { background: rgba(255,120,120,0.25); color:#ff6b6b; }
.icon-green { background: rgba(170,235,140,0.25); color:#76b84e; }
.icon-purple{ background: rgba(170,165,255,0.25); color:#8b82ff; }

/* ===== Chart Containers ===== */
.chart-wrapper {
    height: 250px; /* FIXED HEIGHT – membuat semua sejajar */
}

/* ===== Journal ===== */
.journal-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.journal-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    margin-bottom: 10px;
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(190,180,255,0.35);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    cursor: pointer;
    transition: 0.25s ease;
    position: relative;
}

.journal-item::before {
    content: "";
    position: absolute;
    left: 0;
    top: 6px;
    bottom: 6px;
    width: 4px;
    border-radius: 10px;
    background: linear-gradient(180deg, #bca7ff, #98b8ff);
}

.journal-item:hover {
    transform: translateY(-2px);
    background: rgba(255,255,255,0.7);
    box-shadow: 0 6px 14px rgba(160,150,255,0.22);
}

.journal-title {
    font-size: 15px;
    font-weight: 600;
    color: #2a2f3d;
    max-width: 75%;
}

.journal-date {
    font-size: 13px;
    color: #7b7fa8;
    font-weight: 500;
}

/* ===== FIX GRID ===== */
/* Semua card sejajar dan sama tinggi */
.row.g-4 > div {
    display: flex;
    align-items: stretch;
}
</style>


<div class="container-fluid px-4 py-3">

    <h3 class="fw-bold mb-4" style="color:#2a2f3d;">Dashboard Keuangan</h3>


    {{-- ============================= --}}
    {{-- TOP METRICS --}}
    {{-- ============================= --}}
    <div class="row g-4">

        <div class="col-md-3 d-flex">
            <div class="card-premium w-100">
                <div class="metric-icon icon-blue"><i class="bi bi-box-seam"></i></div>
                <div class="metric-label">Total Aset</div>
                <div class="metric-value"><small>Rp</small>{{ number_format($asset,0,',','.') }}</div>
            </div>
        </div>

        <div class="col-md-3 d-flex">
            <div class="card-premium w-100">
                <div class="metric-icon icon-red"><i class="bi bi-exclamation-octagon"></i></div>
                <div class="metric-label">Total Liabilitas</div>
                <div class="metric-value text-danger"><small>Rp</small>{{ number_format($liability,0,',','.') }}</div>
            </div>
        </div>

        <div class="col-md-3 d-flex">
            <div class="card-premium w-100">
                <div class="metric-icon icon-green"><i class="bi bi-building"></i></div>
                <div class="metric-label">Ekuitas</div>
                <div class="metric-value text-success"><small>Rp</small>{{ number_format($equity,0,',','.') }}</div>
            </div>
        </div>

        <div class="col-md-3 d-flex">
            <div class="card-premium w-100">
                <div class="metric-icon icon-purple"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="metric-label">Laba Bersih</div>
                <div class="metric-value {{ $profitThisMonth >= 0 ? 'text-success':'text-danger' }}">
                    <small>Rp</small>{{ number_format($profitThisMonth,0,',','.') }}
                </div>
            </div>
        </div>

    </div>



    {{-- ============================= --}}
    {{-- CHARTS --}}
    {{-- ============================= --}}
    <div class="row g-4 mt-2">

        <div class="col-md-6 d-flex">
            <div class="card-premium w-100">
                <h6 class="fw-bold mb-3">Pendapatan per Bulan</h6>
                <div class="chart-wrapper">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex">
            <div class="card-premium w-100">
                <h6 class="fw-bold mb-3">Arus Kas</h6>
                <div class="chart-wrapper">
                    <canvas id="cashflowChart"></canvas>
                </div>
            </div>
        </div>

    </div>



    {{-- ============================= --}}
    {{-- EXPENSE + JOURNAL --}}
    {{-- ============================= --}}
    <div class="row g-4 mt-1">

        <div class="col-md-6 d-flex">
            <div class="card-premium w-100">
                <h6 class="fw-bold mb-3">Pengeluaran per Kategori</h6>

                {{-- Pie kecil & center --}}
                <div style="height:240px; display:flex; justify-content:center; align-items:center;">
                    <canvas id="expensePie" style="max-width:180px;"></canvas>
                </div>

            </div>
        </div>

        <div class="col-md-6 d-flex">
            <div class="card-premium w-100">
                <h6 class="fw-bold mb-3">5 Jurnal Terbaru</h6>

                <ul class="journal-list">
                    @foreach($recentJournals as $jr)
                    <li class="journal-item">
                        <div class="journal-title">{{ $jr->description }}</div>
                        <div class="journal-date">{{ $jr->date }}</div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>

    </div>

</div>

@endsection



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/* ================================
   INCOME CHART
================================ */
let incomeCtx = document.getElementById('incomeChart').getContext('2d');

const gradientIncome = incomeCtx.createLinearGradient(0,0,0,300);
gradientIncome.addColorStop(0, 'rgba(147,134,255,0.32)');
gradientIncome.addColorStop(1, 'rgba(147,134,255,0.05)');

new Chart(incomeCtx, {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: "Pendapatan",
            data: @json($incomeTotals),
            borderColor: "#9386ff",
            backgroundColor: gradientIncome,
            borderWidth: 3,
            pointRadius: 4,
            pointBackgroundColor: "#9386ff",
            tension: 0.32,
            fill: true
        }]
    }
});


/* ================================
   CASHFLOW
================================ */
new Chart(document.getElementById('cashflowChart'), {
    type: 'bar',
    data: {
        labels: ["Kas Masuk", "Kas Keluar"],
        datasets: [{
            label: "Cashflow",
            data: [{{ $cashIn }}, {{ $cashOut }}],
            backgroundColor: ["#b0d981", "#ff9a9a"],
            borderRadius: 14
        }]
    }
});


/* ================================
   EXPENSE PIE (kecil & center)
================================ */
new Chart(document.getElementById('expensePie'), {
    type: 'pie',
    data: {
        labels: @json($expenseBreakdown->pluck('category_name')),
        datasets: [{
            data: @json($expenseBreakdown->pluck('total')),
            backgroundColor: [
                "#9386ff",
                "#b7afff",
                "#a7d68b",
                "#ffdd99",
                "#ff9f9f",
                "#d4ccff"
            ]
        }]
    },
    options: {
        maintainAspectRatio: false
    }
});

</script>
@endsection
