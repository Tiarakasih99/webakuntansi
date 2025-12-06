<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            // 1. Tambah kolom category_id (nullable dulu)
            $table->foreignId('category_id')
                ->nullable()
                ->after('name');
        });

        // 2. Mapping kolom "type" lama -> category_id baru
        DB::table('accounts')->get()->each(function ($account) {

            // mapping type lama ke id kategori
            $categoryId = match($account->type) {
                'asset'     => 1,
                'liability' => 2,
                'equity'    => 3,
                'revenue'   => 4,
                'expense'   => 5,
                default     => null,
            };

            DB::table('accounts')->where('id', $account->id)->update([
                'category_id' => $categoryId
            ]);
        });

        Schema::table('accounts', function (Blueprint $table) {
            // 3. Bikin kolom category_id wajib (NOT NULL)
            $table->foreignId('category_id')->nullable(false)->change();

            // 4. Hapus kolom lama
            $table->dropColumn(['type', 'normal_balance']);

            // NOTE: kolom 'balance' boleh kamu hapus jika memang
            // tidak dipakai. Kalau masih dipakai, jangan hapus ya.
            // $table->dropColumn('balance');

            // 5. Tambahkan foreign key constraint
            $table->foreign('category_id')
                ->references('id')
                ->on('account_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // kembalikan kolom lama
            $table->string('type')->nullable();
            $table->string('normal_balance')->nullable();
        });
    }

};
