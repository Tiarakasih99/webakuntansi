@extends('layouts.main')

@section('title', 'Jurnal Umum')

@section('content')
<h1>Jurnal Umum</h1>
<a href="{{ route('journals.create') }}" class="btn btn-success mb-3">+ Tambah Jurnal Baru</a>

<table class="table table-bordered table-striped">
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
            <td>{{ $loop->iteration + ($journals->currentPage() - 1) * $journals->perPage() }}</td> <!-- Perbaiki nomor urut untuk pagination -->
            <td>{{ $journal->transaction_number }}</td>
            <td>{{ $journal->date }}</td>
            <td>{{ number_format($journal->total, 2, ',', '.') }}</td> <!-- Format Indonesia untuk total -->
            <td>
                <a href="{{ route('journals.show', $journal) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('journals.edit', $journal) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('journals.destroy', $journal) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus jurnal ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada data jurnal.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center mt-5">
    {{ $journals->links() }}
</div>

@endsection