<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Jenis laporan, e.g., 'trial_balance', 'income_statement', 'balance_sheet'
            $table->date('period_start'); // Tanggal mulai periode
            $table->date('period_end'); // Tanggal akhir periode
            $table->json('data'); // Data laporan dalam format JSON (misal, array total per akun/tipe)
            $table->decimal('total_assets', 15, 2)->nullable(); // Total asset (untuk balance sheet)
            $table->decimal('total_liabilities', 15, 2)->nullable(); // Total liability
            $table->decimal('total_equity', 15, 2)->nullable(); // Total equity
            $table->decimal('net_income', 15, 2)->nullable(); // Laba bersih (untuk income statement)
            $table->unsignedBigInteger('user_id')->nullable(); // FK ke users, kalau pakai auth
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['type', 'period_start', 'period_end']); // Index untuk query cepat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};