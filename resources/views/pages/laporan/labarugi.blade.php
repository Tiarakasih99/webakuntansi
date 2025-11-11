@extends('layouts.main')

@section('title', 'Laporan Laba Rugi')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Generate Laporan Laba Rugi</h5>
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.labarugi.generate') }}" method="POST" target="_blank">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-text"></i> Generate PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Preview Section (Opsional) --}}
    @if(isset($laporan))
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0">Preview Laporan Laba Rugi</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Pendapatan</td>
                        <td>Rp {{ number_format($laporan['pendapatan'], 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Total Pengeluaran</td>
                        <td>Rp {{ number_format($laporan['pengeluaran'], 0, ',', '.') }}</td>
                    </tr>
                    <tr class="fw-bold">
                        <td>Laba Bersih</td>
                        <td>Rp {{ number_format($laporan['laba_bersih'], 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
