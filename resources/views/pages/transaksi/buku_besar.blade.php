@extends('layouts.main')

@section('title', 'Buku Besar')

@section('content')
<div class="card shadow-sm mt-0" style="margin-top:-25px;"> 
    <div class="card-body">
        <h4 class="card-title mb-3 text-success fw-bold">📗 Buku Besar</h4>
        <p class="text-muted">
            Menampilkan saldo setiap akun dari jurnal umum yang sudah diposting.  
            Gunakan filter di bawah ini untuk melihat transaksi akun tertentu berdasarkan periode.
        </p>

        {{-- 🔹 Form Filter Buku Besar --}}
        <form action="#" method="GET" class="mb-4 filter-form">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="akun" class="form-label">Pilih Akun</label>
                    <select name="akun" id="akun" class="form-select" required>
                        <option value="">-- Pilih Akun --</option>
                        <option value="Kas">Kas</option>
                        <option value="Perlengkapan">Perlengkapan</option>
                        <option value="Utang">Utang</option>
                        <option value="Modal">Modal</option>
                        <option value="Pendapatan">Pendapatan</option>
                        <option value="Beban">Beban</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="periode_awal" class="form-label">Periode Awal</label>
                    <input type="date" id="periode_awal" name="periode_awal" class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="periode_akhir" class="form-label">Periode Akhir</label>
                    <input type="date" id="periode_akhir" name="periode_akhir" class="form-control">
                </div>

                <div class="col-md-2 text-end">
                    <button type="submit" class="btn btn-success w-100">Tampilkan</button>
                </div>
            </div>
        </form>

        {{-- 🔹 Tabel Buku Besar --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle table-hover">
                <thead class="table-success">
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Debet (Rp)</th>
                        <th>Kredit (Rp)</th>
                        <th>Saldo (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- 🔸 Contoh Data Dummy --}}
                    <tr>
                        <td>01-11-2025</td>
                        <td>Setoran Modal Awal</td>
                        <td>10.000.000</td>
                        <td>-</td>
                        <td>10.000.000</td>
                    </tr>
                    <tr>
                        <td>03-11-2025</td>
                        <td>Pembelian Perlengkapan</td>
                        <td>-</td>
                        <td>2.000.000</td>
                        <td>8.000.000</td>
                    </tr>
                    <tr>
                        <td>05-11-2025</td>
                        <td>Penerimaan Pendapatan</td>
                        <td>5.000.000</td>
                        <td>-</td>
                        <td>13.000.000</td>
                    </tr>
                    <tr class="table-secondary fw-bold">
                        <td colspan="4" class="text-end">Saldo Akhir</td>
                        <td>Rp 13.000.000</td>
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

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dce4ec;
        transition: 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #27ae60;
        box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25);
    }

    .btn-success {
        background-color: #27ae60;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-success:hover {
        background-color: #219150;
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

    .table-success {
        background-color: #27ae60 !important;
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f9f3;
    }

    .table-secondary {
        background-color: #f7f9fa;
    }
</style>
@endpush
