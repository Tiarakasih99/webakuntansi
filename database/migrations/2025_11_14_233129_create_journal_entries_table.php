<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journal_id'); // FK ke journals
            $table->unsignedBigInteger('account_id'); // FK ke accounts
            $table->decimal('debit', 15, 2)->default(0); // Nilai debit
            $table->decimal('credit', 15, 2)->default(0); // Nilai kredit
            $table->text('description')->nullable(); // Keterangan per entri
            $table->timestamps();

            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};