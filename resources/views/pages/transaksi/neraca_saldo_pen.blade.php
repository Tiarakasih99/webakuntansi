@extends('layouts.main')

@section('title', 'Neraca Setelah Penyesuaian')

@section('content')
<div class="card shadow-sm mt-0" style="margin-top:-10px;">
    <div class="card-body">
        <h4 class="card-title mb-3 text-primary fw-bold">📊 Neraca Setelah Penyesuaian</h4>
        <p class="text-muted mb-4">
            Menampilkan saldo akun setelah jurnal penyesuaian dilakukan.  
            Pastikan total <strong>Debet</strong> dan <strong>Kredit</strong> seimbang ⚖️
        </p>

        {{-- 🔹 Tabel Neraca --}}
        <div class="table-responsive neraca-table-container">
            <table class="table table-bordered align-middle text-center neraca-table">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Akun</th>
                        <th>Kode Akun</th>
                        <th>Debet (Rp)</th>
                        <th>Kredit (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh data statis (nanti bisa diganti dynamic) --}}
                    <tr>
                        <td>1</td>
                        <td>Kas</td>
                        <td>101</td>
                        <td>15,000,000</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Perlengkapan</td>
                        <td>105</td>
                        <td>2,500,000</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Utang Usaha</td>
                        <td>201</td>
                        <td>-</td>
                        <td>5,000,000</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Modal Pemilik</td>
                        <td>301</td>
                        <td>-</td>
                        <td>12,500,000</td>
                    </tr>
                </tbody>
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td colspan="3">Total</td>
                        <td>17,500,000</td>
                        <td>17,500,000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 15px;
        margin-top: -10px;
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        color: #2c3e50;
        font-weight: 700;
    }

    .text-muted {
        color: #6c757d !important;
    }

    /* 🔹 Tabel Neraca */
    .neraca-table-container {
        background-color: #f9fbfc;
        border-radius: 12px;
        border: 1px solid #eef3f7;
        padding: 1.5rem;
    }

    .neraca-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 15px;
    }

    .neraca-table th {
        background-color: #3498db !important;
        color: white;
        font-weight: 600;
        border-color: #dce4ec;
    }

    .neraca-table td, .neraca-table th {
        vertical-align: middle;
        border: 1px solid #dee2e6;
        padding: 10px;
    }

    .neraca-table tbody tr:hover {
        background-color: #f4f9ff;
        transition: 0.2s ease;
    }

    .neraca-table tfoot {
        background-color: #f1f3f5;
        color: #2c3e50;
    }

    /* 🔹 Responsif */
    @media (max-width: 768px) {
        .neraca-table th, .neraca-table td {
            font-size: 14px;
            padding: 8px;
        }
    }
</style>
@endpush
