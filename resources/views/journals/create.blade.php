@extends('layouts.main')

@section('title', 'Tambah Jurnal')

@section('content')

<div class="container-fluid p-3">
    <h3 class="title-akun mb-3">Tambah Jurnal Baru</h3>

```
<div class="form-card p-4">
    <form action="{{ route('journals.store') }}" method="POST" id="journalForm">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" id="date" name="date" class="input-soft form-control"
                   required value="{{ old('date', date('Y-m-d')) }}">
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
            <h3 class="sub-title">Rincian Jurnal</h3>
            <button type="button" class="btn-add-akun" data-bs-toggle="modal" data-bs-target="#entryModal">
                + Tambah Entri
            </button>
        </div>
        
        <table class="table journal-table" id="entriesTable">
            <thead>
                <tr>
                    <th>Akun Perkiraan</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
        <button type="submit" class="btn-save-jurnal mt-3">Simpan Jurnal</button>
    </form>
</div>
```

</div>

<!-- MODAL -->

<div class="modal fade" id="entryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modal-soft">
            <form id="entryForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="entryModalLabel">Tambah Entri Jurnal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Akun Perkiraan</label>
                        <select id="accountSelect" class="form-select input-soft" required>
                            <option value="">-- Pilih Akun --</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" data-balance="{{ $account->category->normal_balance }}">
                                    {{ $account->code }} - {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

```
                <div class="mb-3">
                    <label class="form-label">Tipe</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="debitRadio" value="debit">
                        <label class="form-check-label" for="debitRadio">Debit</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="creditRadio" value="credit">
                        <label class="form-check-label" for="creditRadio">Kredit</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nilai</label>
                    <input type="number" id="amountInput" class="form-control input-soft" min="0.01" step="0.01" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea id="descInput" class="form-control input-soft" rows="2"></textarea>
                </div>

                <input type="hidden" id="entryMode" value="main">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-add-entry" id="addEntryBtn">Lanjut</button>
            </div>
        </form>
    </div>
</div>
```

</div>

<script>
$(document).ready(function(){
    let firstEntryAmount = 0;
    let firstEntryType = '';
    let rowIndex = 0;

    function addRow(accountId, accountText, debit, credit, desc){
        let row = `<tr>
            <td>${accountText}<input type="hidden" name="entries[${rowIndex}][account_id]" value="${accountId}"></td>
            <td>${debit.toFixed(2)}<input type="hidden" name="entries[${rowIndex}][debit]" value="${debit.toFixed(2)}"></td>
            <td>${credit.toFixed(2)}<input type="hidden" name="entries[${rowIndex}][credit]" value="${credit.toFixed(2)}"></td>
            <td>${desc}<input type="hidden" name="entries[${rowIndex}][description]" value="${desc}"></td>
            <td><button type="button" class="btn btn-danger btn-sm removeRowBtn">Hapus</button></td>
        </tr>`;
        $('#entriesTable tbody').append(row);
        rowIndex++;
    }

    $('#accountSelect').change(function(){
        if ($('#entryMode').val() === 'contra') return;
        let balance = $(this).find('option:selected').data('balance');
        $('input[name="type"]').prop('checked', false);
        if (balance === 'debit') $('#debitRadio').prop('checked', true);
        if (balance === 'credit') $('#creditRadio').prop('checked', true);
    });

    $('#addEntryBtn').click(function(){
        let accountId = $('#accountSelect').val();
        let accountText = $('#accountSelect option:selected').text();
        let type = $('input[name="type"]:checked').val();
        let amount = parseFloat($('#amountInput').val());
        let desc = $('#descInput').val().trim();
        let mode = $('#entryMode').val();

        if(!accountId || !type || isNaN(amount) || amount <= 0){
            alert('Lengkapi data dengan benar!');
            return;
        }

        let debit = (type === 'debit') ? amount : 0;
        let credit = (type === 'credit') ? amount : 0;

        if(mode === 'main'){
            firstEntryAmount = amount;
            firstEntryType = type;
            addRow(accountId, accountText, debit, credit, desc);
        } else if(mode === 'contra'){
            addRow(accountId, accountText, debit, credit, 'Kontra: ' + desc);
        }

        $('#entryForm')[0].reset();
        $('#entryModal').modal('hide');
        $('#entryMode').val('main');
    });

    $('#entryModal').on('show.bs.modal', function () {
        if($('#entriesTable tbody tr').length === 0){
            $('#entryMode').val('main');
            $('#entryModalLabel').text('Tambah Entri Jurnal');
            $('#amountInput').val('').prop('readonly', false);
            $('input[name="type"]').prop('checked', false);
        } else {
            $('#entryMode').val('contra');
            $('#entryModalLabel').text('Tambah Entri Kontra');
            $('#amountInput').val(firstEntryAmount.toFixed(2)).prop('readonly', false);
            if(firstEntryType === 'debit') $('#creditRadio').prop('checked', true);
            else $('#debitRadio').prop('checked', true);
        }
    });

    $(document).on('click', '.removeRowBtn', function(){
        $(this).closest('tr').remove();
        if($('#entriesTable tbody tr').length === 0){
            firstEntryAmount = 0;
            firstEntryType = '';
            rowIndex = 0;
        }
    });

    $('#journalForm').submit(function(e){
        let totalDebit = 0;
        let totalCredit = 0;
        $('#entriesTable tbody tr').each(function(){
            totalDebit += parseFloat($(this).find('input[name$="[debit]"]').val()) || 0;
            totalCredit += parseFloat($(this).find('input[name$="[credit]"]').val()) || 0;
        });

        if(totalDebit !== totalCredit){
            e.preventDefault();
            alert('Total debit dan kredit harus sama!');
        }
    });
});
</script>

@endsection
