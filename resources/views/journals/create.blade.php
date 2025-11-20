@extends('layouts.main')

@section('title', 'Tambah Jurnal')

@section('content')
<h1>Tambah Jurnal Baru</h1>

<form action="{{ route('journals.store') }}" method="POST" id="journalForm">
    @csrf
    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" id="date" name="date" class="form-control" required value="{{ old('date', date('Y-m-d')) }}">
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
            <!-- Baris rincian jurnal akan muncul di sini -->
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Simpan Jurnal</button>
</form>

<!-- Modal Untuk Input Entri -->
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
                                <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
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
$(document).ready(function(){  // Pastikan jQuery siap
    // Tambah entri ke tabel rincian
    $('#addEntryBtn').click(function(){
        let accountId = $('#accountSelect').val();
        let accountText = $('#accountSelect option:selected').text();
        let type = $('input[name="type"]:checked').val();
        let amount = parseFloat($('#amountInput').val());
        let desc = $('#descInput').val().trim();

        if(!accountId || !type || isNaN(amount) || amount <= 0) {
            alert('Lengkapi data dengan benar!');
            return;
        }

        let debit = (type === 'debit') ? amount : 0;
        let credit = (type === 'credit') ? amount : 0;

        let row = `<tr>
            <td>${accountText}<input type="hidden" name="entries[][account_id]" value="${accountId}"></td>
            <td>${debit.toFixed(2)}<input type="hidden" name="entries[][debit]" value="${debit.toFixed(2)}"></td>
            <td>${credit.toFixed(2)}<input type="hidden" name="entries[][credit]" value="${credit.toFixed(2)}"></td>
            <td>${desc}<input type="hidden" name="entries[][description]" value="${desc}"></td>
            <td><button type="button" class="btn btn-danger btn-sm removeRowBtn">Hapus</button></td>
        </tr>`;

        $('#entriesTable tbody').append(row);

        // Tutup modal dan reset form
        $('#entryModal').modal('hide');
        $('#entryForm')[0].reset();
    });

    // Hapus baris entri
    $(document).on('click', '.removeRowBtn', function(){
        $(this).closest('tr').remove();
    });

    // Validasi sebelum submit: cek debit = kredit
    $('#journalForm').submit(function(e){
        let totalDebit = 0;
        let totalCredit = 0;
        $('#entriesTable tbody tr').each(function(){
            totalDebit += parseFloat($(this).find('input[name$="[debit]"]').val()) || 0;
            totalCredit += parseFloat($(this).find('input[name$="[credit]"]').val()) || 0;
        });

        if(Math.abs(totalDebit - totalCredit) > 0.01){  // Toleransi kecil untuk floating point
            e.preventDefault();
            alert('Total debit dan kredit harus sama!');
        } else if ($('#entriesTable tbody tr').length === 0) {
            e.preventDefault();
            alert('Harap tambahkan minimal satu entri jurnal!');
        }
    });
});
</script>
@endsection