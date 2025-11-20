@extends('layouts.main')

@section('title', 'Detail Jurnal')

@section('content')
<h1>Detail Jurnal - No Transaksi: {{ $journal->transaction_number }}</h1>

<p><strong>Tanggal:</strong> {{ $journal->date }}</p>
<p><strong>Deskripsi:</strong> {{ $journal->description ?? '-' }}</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Akun Perkiraan</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($journal->entries as $entry)
        <tr>
            <td>{{ $entry->account->code }} - {{ $entry->account->name }}</td>
            <td>{{ number_format($entry->debit, 2) }}</td>
            <td>{{ number_format($entry->credit, 2) }}</td>
            <td>{{ $entry->description ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <th>{{ number_format($journal->entries->sum('debit'), 2) }}</th>
            <th>{{ number_format($journal->entries->sum('credit'), 2) }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>

<a href="{{ route('journals.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>

@endsection