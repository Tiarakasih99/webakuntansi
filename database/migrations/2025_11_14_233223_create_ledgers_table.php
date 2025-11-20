<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id'); // FK ke accounts
            $table->unsignedBigInteger('journal_entry_id'); // FK ke journal_entries
            $table->date('date'); // Tanggal dari journal
            $table->decimal('debit', 15, 2)->default(0); // Debit dari entri
            $table->decimal('credit', 15, 2)->default(0); // Kredit dari entri
            $table->decimal('balance', 15, 2); // Saldo kumulatif setelah transaksi
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('journal_entry_id')->references('id')->on('journal_entries')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};