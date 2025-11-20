<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // Kode akun, unik
            $table->string('name'); // Nama akun
            $table->enum('type', ['asset', 'liability', 'equity', 'revenue', 'expense']); // Tipe akun
            $table->decimal('balance', 15, 2)->default(0); // Saldo awal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};