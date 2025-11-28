@extends('layouts.main')

@section('title', 'Edit Jurnal')

@section('content')
<h1>Edit Jurnal - No Transaksi: {{ $journal->transaction_number }}</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('journals.update', $journal) }}" method="POST" id="journalForm">
    @csrf
    @method('PUT') <!-- Untuk update -->
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" id="date" name="date" class="form-control" required value="{{ old('date', $journal->date) }}">
    </div>

    <h3>Rincian Jurnal</h3>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#entryModal">Tambah Entri</button>

    <table class="table table-bordered" id="entriesTable">
        <thead>
            <tr>
                <th>Akun Perkiraan</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Pre-fill entries dari journal -->
            @foreach($journal->entries as $index => $entry)
            <tr id="row-{{ $index }}"> <!-- Tambahkan ID unik -->
                <td>{{ $entry->account->code }} - {{ $entry->account->name }}<input type="hidden" name="entries[{{ $index }}][account_id]" value="{{ $entry->account_id }}"></td>
                <td>{{ number_format($entry->debit, 2) }}<input type="hidden" name="entries[{{ $index }}][debit]" value="{{ $entry->debit }}"></td>
                <td>{{ number_format($entry->credit, 2) }}<input type="hidden" name="entries[{{ $index }}][credit]" value="{{ $entry->credit }}"></td>
                <td>{{ $entry->description ?? '-' }}<input type="hidden" name="entries[{{ $index }}][description]" value="{{ $entry->description }}"></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm editRowBtn" data-index="{{ $index }}">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm removeRowBtn">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Update Jurnal</button> <!-- Diubah dari "Simpan Jurnal" -->
    <a href="{{ route('journals.index') }}" class="btn btn-secondary">Kembali</a>
</form>

<!-- Modal Entri (sama seperti create) -->
<div class="modal fade" id="entryModal" tabindex="-1" aria-labelledby="entryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="entryForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="entryModalLabel">Tambah Entri Jurnal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="accountSelect" class="form-label">Akun Perkiraan</label>
                        <select id="accountSelect" class="form-select" required>
                            <option value="">-- Pilih Akun --</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" data-type="{{ $account->type }}">{{ $account->code }} - {{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="debitRadio" value="debit" required>
                            <label class="form-check-label" for="debitRadio">Debit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="creditRadio" value="credit" required>
                            <label class="form-check-label" for="creditRadio">Kredit</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="amountInput" class="form-label">Nilai</label>
                        <input type="number" id="amountInput" class="form-control" min="0.01" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="descInput" class="form-label">Keterangan</label>
                        <textarea id="descInput" class="form-control" rows="2"></textarea>
                    </div>

                    <input type="hidden" id="entryMode" value="main">
                    <input type="hidden" id="editIndex" value="-1"> <!-- Untuk track index saat edit -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="addEntryBtn">Lanjut</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    let firstEntryAmount = 0;
    let firstEntryType = '';
    let rowIndex = {{ count($journal->entries) }};
    let isEditing = false; // <--- FLAG BARU

    function initializeFirstEntry() {
        if ($('#entriesTable tbody tr').length > 0) {
            let firstRow = $('#entriesTable tbody tr').first();
            let debit = parseFloat(firstRow.find('input[name$="[debit]"]').val()) || 0;
            let credit = parseFloat(firstRow.find('input[name$="[credit]"]').val()) || 0;

            if (debit > 0) {
                firstEntryType = 'debit';
                firstEntryAmount = debit;
            } else if (credit > 0) {
                firstEntryType = 'credit';
                firstEntryAmount = credit;
            }
        }
    }

    initializeFirstEntry();

    function addRow(accountId, accountText, debit, credit, desc, isEdit = false, editIndex = -1){
        let indexForName = isEdit ? editIndex : rowIndex;
        let rowId = isEdit ? 'row-' + editIndex : 'row-' + rowIndex;

        let rowHtml = `
        <tr id="${rowId}">
            <td>${accountText}<input type="hidden" name="entries[${indexForName}][account_id]" value="${accountId}"></td>
            <td>${debit.toFixed(2)}<input type="hidden" name="entries[${indexForName}][debit]" value="${debit.toFixed(2)}"></td>
            <td>${credit.toFixed(2)}<input type="hidden" name="entries[${indexForName}][credit]" value="${credit.toFixed(2)}"></td>
            <td>${desc}<input type="hidden" name="entries[${indexForName}][description]" value="${desc}"></td>
            <td>
                <button type="button" class="btn btn-warning btn-sm editRowBtn" data-index="${indexForName}">Edit</button>
                <button type="button" class="btn btn-danger btn-sm removeRowBtn">Hapus</button>
            </td>
        </tr>`;

        if (isEdit) {
            $('#' + rowId).replaceWith(rowHtml);
            if (editIndex == 0) initializeFirstEntry();
        } else {
            $('#entriesTable tbody').append(rowHtml);
            rowIndex++;
        }
    }

    // -----------------------------
    // AUTO SELECT TIPE AKUN (DEBIT/KREDIT)
    // -----------------------------
    $('#accountSelect').change(function(){

        // STOP AUTO-SELECT kalau sedang edit
        if (isEditing) return; 

        let selectedOption = $(this).find('option:selected');
        let accountType = selectedOption.data('type');

        $('input[name="type"]').prop('checked', false);

        if (accountType === 'asset' || accountType === 'expense') {
            $('#debitRadio').prop('checked', true);
        } 
        else if (accountType === 'liability' || accountType === 'equity' || accountType === 'revenue') {
            $('#creditRadio').prop('checked', true);
        }
    });

    // -----------------------------
    // TOMBOL ADD ENTRY / EDIT ENTRY
    // -----------------------------
    $('#addEntryBtn').click(function(){
        let accountId = $('#accountSelect').val();
        let accountText = $('#accountSelect option:selected').text();
        let type = $('input[name="type"]:checked').val();
        let amount = parseFloat($('#amountInput').val());
        let desc = $('#descInput').val().trim();
        let editIndex = parseInt($('#editIndex').val());
        let mode = $('#entryMode').val();

        if(!accountId || !type || isNaN(amount) || amount <= 0){
            alert('Lengkapi data dengan benar!');
            return;
        }

        let debit = type === 'debit' ? amount : 0;
        let credit = type === 'credit' ? amount : 0;

        if (editIndex >= 0) {
            addRow(accountId, accountText, debit, credit, desc, true, editIndex);
        } else if (mode === 'main') {
            firstEntryAmount = amount;
            firstEntryType = type;
            addRow(accountId, accountText, debit, credit, desc);
        } else if (mode === 'contra') {
            let contraDebit = firstEntryType === 'debit' ? 0 : firstEntryAmount;
            let contraCredit = firstEntryType === 'credit' ? 0 : firstEntryAmount;
            addRow(accountId, accountText, contraDebit, contraCredit, 'Kontra: ' + desc);
        }

        // RESET
        $('#entryForm')[0].reset();
        $('#entryModal').modal('hide');
        $('#editIndex').val('-1');
        $('#entryMode').val('main');
        isEditing = false;
    });

    // -----------------------------
    // MODAL OPEN LOGIC
    // -----------------------------
    $('#entryModal').on('show.bs.modal', function () {
        let editIndex = parseInt($('#editIndex').val());

        if (editIndex >= 0) {
            $('#entryMode').val('main');
            $('#entryModalLabel').text('Edit Entri Jurnal');
        }
        else if($('#entriesTable tbody tr').length === 0){
            $('#entryMode').val('main');
            $('#entryModalLabel').text('Tambah Entri Jurnal');
        }
        else {
            $('#entryMode').val('contra');
            $('#entryModalLabel').text('Tambah Entri Kontra');

            $('#amountInput').val(firstEntryAmount.toFixed(2));
            if(firstEntryType === 'debit') $('#creditRadio').prop('checked', true);
            else $('#debitRadio').prop('checked', true);
        }
    });

    // -----------------------------
    // RESET FLAG EDIT SAAT MODAL TERTUTUP
    // -----------------------------
    $('#entryModal').on('hidden.bs.modal', function () {
        isEditing = false;
        $('#entryForm')[0].reset();
    });

    // -----------------------------
    // TOMBOL EDIT ROW
    // -----------------------------
    $(document).on('click', '.editRowBtn', function(){
        isEditing = true; // <-- FIX PENTING

        let row = $(this).closest('tr');
        let index = $(this).data('index');
        let accountId = row.find('input[name$="[account_id]"]').val();
        let debit = parseFloat(row.find('input[name$="[debit]"]').val()) || 0;
        let credit = parseFloat(row.find('input[name$="[credit]"]').val()) || 0;
        let desc = row.find('input[name$="[description]"]').val();

        $('#accountSelect').val(accountId);
        $('#descInput').val(desc);

        if (debit > 0) {
            $('#debitRadio').prop('checked', true);
            $('#amountInput').val(debit.toFixed(2));
        } else {
            $('#creditRadio').prop('checked', true);
            $('#amountInput').val(credit.toFixed(2));
        }

        $('#editIndex').val(index);
        $('#entryModal').modal('show');
    });

    // -----------------------------
    // DELETE ROW
    // -----------------------------
    $(document).on('click', '.removeRowBtn', function(){
        $(this).closest('tr').remove();

        if($('#entriesTable tbody tr').length === 0){
            firstEntryAmount = 0;
            firstEntryType = '';
            rowIndex = 0;
        }
    });

    // -----------------------------
    // VALIDASI SEBELUM SUBMIT
    // -----------------------------
    $('#journalForm').submit(function(e){
        let totalDebit = 0;
        let totalCredit = 0;

        $('#entriesTable tbody tr').each(function(){
            totalDebit += parseFloat($(this).find('input[name$="[debit]"]').val()) || 0;
            totalCredit += parseFloat($(this).find('input[name$="[credit]"]').val()) || 0;
        });

        if($('#entriesTable tbody tr').length === 0){
            e.preventDefault();
            alert('Harap tambahkan minimal satu entri jurnal!');
            return;
        }

        if(Math.abs(totalDebit - totalCredit) > 0.01){
            e.preventDefault();
            alert('Total debit dan kredit harus sama!');
        }
    });

});
</script>
@endsection
