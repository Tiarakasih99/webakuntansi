@extends('layouts.main')

@section('title', 'Buku Besar')

@section('content')
<h1 class="mb-4">Buku Besar</h1>

@foreach($accounts as $account)
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ $account->name }} ({{ $account->code }})</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th class="text-end">Debit</th>
                    <th class="text-end">Kredit</th>
                    <th class="text-end">Saldo</th>
                </tr>
            </thead>
            <tbody>
                @php $balance = $account->balance ?? 0; @endphp
                @foreach($account->journalEntries as $entry)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($entry->journal->date)->format('d M Y') }}</td>
                    <td class="text-end">{{ number_format($entry->debit, 2) }}</td>
                    <td class="text-end">{{ number_format($entry->credit, 2) }}</td>
                    <td class="text-end">{{ number_format($balance += $entry->debit - $entry->credit, 2) }}</td>
                </tr>
                @endforeach
                @if($account->journalEntries->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">Belum ada transaksi</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endsection
