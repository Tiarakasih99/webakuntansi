@extends('layouts.main')

@section('title', 'Buku Besar')

@section('content')
<h1>Buku Besar</h1>

@foreach($accounts as $account)
    <h3>{{ $account->name }} ({{ $account->code }})</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php $balance = $account->balance; @endphp
            @foreach($account->journalEntries as $entry)
            <tr>
                <td>{{ $entry->journal->date }}</td>
                <td>{{ number_format($entry->debit, 2) }}</td>
                <td>{{ number_format($entry->credit, 2) }}</td>
                <td>{{ number_format($balance += $entry->debit - $entry->credit, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
@endsection