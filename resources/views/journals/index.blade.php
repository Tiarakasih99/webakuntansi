@extends('layouts.main')

@section('title', 'Jurnal Umum')

@section('content')
<link rel="stylesheet" href="{{ asset('css/journal.css') }}">

<div class="container-fluid p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="title-akun">Jurnal Umum</h3>

        <a href="{{ route('journals.create') }}" class="btn-add-akun">
            + Tambah Jurnal Baru
        </a>
    </div>

    <div class="form-card mt-3">
        <div class="p-3">

            <table class="table journal-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($journals as $journal)
                    <tr>
                        <td>{{ $loop->iteration + ($journals->currentPage() - 1) * $journals->perPage() }}</td>
                        <td>{{ $journal->transaction_number }}</td>
                        <td>{{ $journal->date }}</td>
                        <td>Rp {{ number_format($journal->total, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('journals.show', $journal) }}" class="btn-detail">Detail</a>
                            <a href="{{ route('journals.edit', $journal) }}" class="btn-edit">Edit</a>

                            <form action="{{ route('journals.destroy', $journal) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus jurnal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Belum ada data jurnal.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $journals->links() }}
            </div>
        </div>
    </div>

</div>

<style>
    /* CARD WRAPPER */
    .form-card {
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 3px 15px rgba(0,0,0,0.07);
        border: none;
    }
    
    /* TITLE */
    .title-akun {
        color: #1b2737;
        font-weight: 700;
    }
    
    /* BUTTON TAMBAH */
    .btn-add-akun {
        background: linear-gradient(90deg, #5d53a6, #8fa1e0);
        border: none;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        color: white !important;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        transition: .25s ease;
        text-decoration: none;
    }
    
    .btn-add-akun:hover {
        transform: translateY(-2px);
        opacity: 0.95;
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }
    
    /* TABLE */
    .journal-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px; /* gap antar row */
    }
    
    .journal-table thead tr {
        background: #eef0fa;
        border-radius: 12px;
    }
    
    .journal-table thead th {
        padding: 12px;
        color: #1b2737;
        font-weight: 600;
        border-bottom: none;
    }
    
    .journal-table tbody tr {
        background: #fbfbff;
        border-radius: 12px;
        transition: .25s ease;
    }
    
    .journal-table tbody tr:hover {
        background: #f1f2fe;
        transform: translateY(-2px);
    }
    
    .journal-table td {
        padding: 14px;
        vertical-align: middle;
        border-top: none;
    }
    
    /* BUTTON DETAIL */
    .btn-detail {
        padding: 6px 10px;
        background: #5ab6df;
        color: #fff !important;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s ease;
    }
    
    .btn-detail:hover {
        opacity: 0.75;
    }
    
    /* BUTTON EDIT */
    .btn-edit {
        padding: 6px 10px;
        background: #f2b760;
        color: #fff !important;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s ease;
    }
    
    .btn-edit:hover {
        opacity: 0.75;
    }
    
    /* BUTTON DELETE */
    .btn-delete {
        padding: 6px 10px;
        background: #e57373;
        border: none;
        color: #fff;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s ease;
    }
    
    .btn-delete:hover {
        opacity: 0.75;
    }
</style>
@endsection