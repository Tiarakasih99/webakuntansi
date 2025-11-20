<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique(); // No transaksi, auto-increment via kode
            $table->date('date'); // Tanggal transaksi
            $table->text('description')->nullable(); // Deskripsi opsional
            $table->decimal('total', 15, 2); // Total debit/kredit (harus balance)
            $table->unsignedBigInteger('user_id')->nullable(); // FK ke users, kalau pakai auth
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};