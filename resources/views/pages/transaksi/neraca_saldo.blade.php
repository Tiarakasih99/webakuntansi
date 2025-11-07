@extends('layouts.main')

@section('title', 'Neraca Saldo')

@section('content')
<div class="card shadow-sm mt-0" style="margin-top:-25px;"> 
    <div class="card-body">
        <h4 class="card-title mb-3 text-info fw-bold">📊 Neraca Saldo</h4>
        <p class="text-muted">
            Menampilkan daftar akun beserta saldo <strong>Debet</strong> dan <strong>Kredit</strong>  
            sebelum penyesuaian dilakukan.
        </p>

        {{-- 🔹 Filter Periode Neraca --}}
        <form action="#" method="GET" class="mb-4 filter-form">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="periode_awal" class="form-label">Periode Awal</label>
                    <input type="date" id="periode_awal" name="periode_awal" class="form-control">
                </div>
                <div class="col-md-5">
                    <label for="periode_akhir" class="form-label">Periode Akhir</label>
                    <input type="date" id="periode_akhir" name="periode_akhir" class="form-control">
                </div>
                <div class="col-md-2 text-end">
                    <button type="submit" class="btn btn-info w-100 text-white">Tampilkan</button>
                </div>
            </div>
        </form>

        {{-- 🔹 Tabel Neraca Saldo --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle table-hover">
                <thead class="table-info">
                    <tr>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Debet (Rp)</th>
                        <th>Kredit (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- 🔸 Contoh Data Dummy --}}
                    <tr>
                        <td>101</td>
                        <td>Kas</td>
                        <td>10.000.000</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>Perlengkapan</td>
                        <td>2.000.000</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>201</td>
                        <td>Utang Usaha</td>
                        <td>-</td>
                        <td>3.000.000</td>
                    </tr>
                    <tr>
                        <td>301</td>
                        <td>Modal Pemilik</td>
                        <td>-</td>
                        <td>8.000.000</td>
                    </tr>
                    <tr>
                        <td>401</td>
                        <td>Pendapatan Jasa</td>
                        <td>-</td>
                        <td>5.000.000</td>
                    </tr>
                    <tr>
                        <td>501</td>
                        <td>Beban Listrik</td>
                        <td>500.000</td>
                        <td>-</td>
                    </tr>

                    {{-- 🔸 Total --}}
                    <tr class="table-secondary fw-bold">
                        <td colspan="2" class="text-end">Total</td>
                        <td>Rp 12.500.000</td>
                        <td>Rp 16.000.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- 🔹 CSS Custom --}}
@push('styles')
<style>
    .card {
        border: none;
        border-radius: 15px;
        margin-top: -25px;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #dce4ec;
        transition: 0.2s ease;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .btn-info {
        background-color: #3498db;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-info:hover {
        background-color: #2d83c2;
        transform: translateY(-1px);
    }

    .filter-form {
        background-color: #f9fbfc;
        padding: 1.2rem 1.5rem;
        border-radius: 12px;
        border: 1px solid #eef3f7;
        margin-bottom: 2rem;
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table-info {
        background-color: #3498db !important;
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: #f4faff;
    }

    .table-secondary {
        background-color: #f7f9fa;
    }
</style>
@endpush
