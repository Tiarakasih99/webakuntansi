@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<style>
/* ===== DASHBOARD THEME: Soft Purple Fitness UI ===== */

    body {
        background: #e7e9ff; /* soft lavender background */
        font-family: 'Inter', sans-serif;
    }

    /* ==== Card Premium Style ==== */
    .card-premium {
        background: #ffffffff;
        border-radius: 22px;
        padding: 26px 28px;
        box-shadow: 0 8px 25px rgba(128, 118, 255, 0.18);
        border: 1px solid rgba(255,255,255,0.4);
        transition: 0.25s ease;
    }
    .card-premium:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 32px rgba(128,118,255,0.22);
    }

    /* ==== Metric Label & Value ==== */
    .metric-label {
        font-size: 13px;
        color: #6f73a7;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .metric-value {
        font-size: 20px;
        font-weight: 700;
        color: #1e2330;
        margin-top: 6px;
    }

    .metric-value small {
        font-size: 14px;
        opacity: 0.75;
        margin-right: 3px;
    }

    /* ==== Icon Bubble ==== */
    .metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 12px;
        font-size: 20px;
        font-weight: 600;
    }

    .icon-blue {
        background: rgba(110, 125, 255, 0.18);
        color: #6c7bff;
    }
    .icon-red {
        background: rgba(255, 140, 140, 0.18);
        color: #ff6b6b;
    }
    .icon-green {
        background: rgba(195, 255, 140, 0.2);
        color: #8bd14f;
    }
    .icon-purple {
        background: rgba(170, 160, 255, 0.22);
        color: #8b89ff;
    }

    /* ==== Chart Wrapper ==== */
    .chart-wrapper {
        height: 250px;
    }

    /* ==== List ==== */
    .list-group-item {
        border: none;
        padding: 14px 8px;
        border-bottom: 1px solid rgba(170,170,255,0.3);
        background: transparent;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }

    /* Title */
    h6, h3 {
        color: #1f2440 !important;
    }
</style>

<div class="container-fluid px-4 py-3">

    <h3 class="fw-bold mb-4" style="color:#1b2737;">Dashboard Keuangan</h3>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card-premium">
                <div class="metric-icon icon-blue">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="metric-label">Total Aset</div>
                <div class="metric-value">
                    <small>Rp</small>{{ number_format($asset,0,',','.') }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-premium">
                <div class="metric-icon icon-red">
                    <i class="bi bi-exclamation-octagon"></i>
                </div>
                <div class="metric-label">Total Liabilitas</div>
                <div class="metric-value text-danger">
                    <small>Rp</small>{{ number_format($liability,0,',','.') }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-premium">
                <div class="metric-icon icon-green">
                    <i class="bi bi-building"></i>
                </div>
                <div class="metric-label">Ekuitas</div>
                <div class="metric-value text-success">
                    <small>Rp</small>{{ number_format($equity,0,',','.') }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-premium">
                <div class="metric-icon icon-purple">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="metric-label">Laba Bersih</div>
                <div class="metric-value {{ $profitThisMonth >= 0 ? 'text-success':'text-danger' }}">
                    <small>Rp</small>{{ number_format($profitThisMonth,0,',','.') }}
                </div>
            </div>
        </div>

    </div>



    {{-- ============================= --}}
    {{--       CHARTS SECTION         --}}
    {{-- ============================= --}}
    <div class="row g-4 mt-2">

        {{-- INCOME CHART --}}
        <div class="col-md-6">
            <div class="card-premium">
                <h6 class="fw-bold mb-3">Pendapatan per Bulan</h6>
                <div class="chart-wrapper">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>

        {{-- CASHFLOW --}}
        <div class="col-md-6">
            <div class="card-premium">
                <h6 class="fw-bold mb-3">Arus Kas</h6>
                <canvas id="cashflowChart" height="220"></canvas>
            </div>
        </div>

    </div>



    {{-- ============================= --}}
    {{--     EXPENSE + RECENT         --}}
    {{-- ============================= --}}
    <div class="row g-4 mt-1">

        <div class="col-md-6">
            <div class="card-premium">
                <h6 class="fw-bold mb-3">Pengeluaran per Kategori</h6>
                <canvas id="expensePie" height="260"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-premium">
                <h6 class="fw-bold mb-3">5 Jurnal Terbaru</h6>
                <ul class="list-group">
                    @foreach($recentJournals as $jr)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $jr->description }}</span>
                        <span class="text-muted">{{ $jr->date }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

</div>

@endsection


{{-- ============================= --}}
{{--          CHART SCRIPT         --}}
{{-- ============================= --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

function createGradient(ctx, color) {
    const g = ctx.createLinearGradient(0, 0, 0, 350);
    g.addColorStop(0, color + "b0");
    g.addColorStop(1, color + "10");
    return g;
}

/* INCOME LINE CHART */
let incomeCtx = document.getElementById('incomeChart').getContext('2d');

const gradientIncome = incomeCtx.createLinearGradient(0,0,0,300);
gradientIncome.addColorStop(0, 'rgba(139,137,255,0.35)');
gradientIncome.addColorStop(1, 'rgba(139,137,255,0.05)');

new Chart(incomeCtx, {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: "Pendapatan",
            data: @json($incomeTotals),
            borderColor: "#8b89ff",
            backgroundColor: gradientIncome,
            borderWidth: 3,
            pointRadius: 4,
            pointBackgroundColor: "#8b89ff",
            tension: 0.4,
            fill: true
        }]
    }
});


/* CASHFLOW BAR */
new Chart(document.getElementById('cashflowChart'), {
    type: 'bar',
    data: {
        labels: ["Kas Masuk", "Kas Keluar"],
        datasets: [{
            label: "Cashflow",
            data: [{{ $cashIn }}, {{ $cashOut }}],
            backgroundColor: ["#c6ff4a", "#ff6b6b"],
            borderRadius: 14
        }]
    }
});



/* EXPENSE PIE */
new Chart(document.getElementById('expensePie'), {
    type: 'pie',
    data: {
        labels: @json($expenseBreakdown->pluck('category_name')),
        datasets: [{
            data: @json($expenseBreakdown->pluck('total')),
            backgroundColor: [
                "#8b89ff",
                "#6c7bff",
                "#c6ff4a",
                "#ffc75f",
                "#ff6b6b",
                "#a29bfe"
            ]
        }]
    }
});


</script>

@endsection
