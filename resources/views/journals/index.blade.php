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
            <td>{{ $loop->iteration }}</td>
            <td>{{ $journal->transaction_number }}</td>
            <td>{{ $journal->date }}</td>
            <td>{{ number_format($journal->total, 2) }}</td>
            <td>
                <a href="{{ route('journals.show', $journal) }}" class="btn btn-info btn-sm">Detail</a>
                <!-- Jika perlu edit / delete bisa ditambah -->
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada data jurnal.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection