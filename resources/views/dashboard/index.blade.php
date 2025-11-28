@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: 0.3s ease;
        font-size: 0.50rem
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .icon-round {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        background: #f0f4ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #0d6efd;
        margin-bottom: 10px;
    }

    .chart-card {
        background: white;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>

<div class="container-fluid">

    <h3 class="fw-bold mb-4">Dashboard Akuntansi</h3>

    {{-- STATISTIC CARDS --}}
    <div class="row g-4">

        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="icon-round"><i class="bi bi-book"></i></div>
                <h6 class="text-muted mb-1">Total Akun Perkiraan</h6>
                <h3 class="fw-bold">{{ $totalAccounts }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="icon-round"><i class="bi bi-journals"></i></div>
                <h6 class="text-muted mb-1">Total Jurnal</h6>
                <h3 class="fw-bold">{{ $totalJournals }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="icon-round"><i class="bi bi-arrow-down-circle"></i></div>
                <h6 class="text-muted mb-1">Total Debit</h6>
                <h4 class="fw-bold text-success">Rp {{ number_format($totalDebit, 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="icon-round"><i class="bi bi-arrow-up-circle"></i></div>
                <h6 class="text-muted mb-1">Total Kredit</h6>
                <h4 class="fw-bold text-danger">Rp {{ number_format($totalKredit, 0, ',', '.') }}</h4>
            </div>
        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="row mt-5 g-4">

        <div class="col-md-6">
            <div class="chart-card">
                <h6 class="fw-bold mb-3">Grafik Transaksi Per Bulan</h6>
                <canvas id="chartTransactions"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="chart-card">
                <h6 class="fw-bold mb-3">5 Jurnal Terbaru</h6>

                <ul class="list-group">
                    @forelse($recentJournals as $journal)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $journal->description }}</span>
                            <span class="text-muted">{{ $journal->date }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Belum ada data jurnal</li>
                    @endforelse
                </ul>

            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// GRAFIK
const ctx1 = document.getElementById('chartTransactions').getContext('2d');

new Chart(ctx1, {
    type: 'line',
    data: {
        labels: @json($chartMonths),
        datasets: [{
            label: 'Jumlah Transaksi',
            data: @json($chartTotals),
            borderWidth: 2,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,0.20)',
            tension: 0.4,
            fill: true
        }]
    }
});
</script>
@endsection
