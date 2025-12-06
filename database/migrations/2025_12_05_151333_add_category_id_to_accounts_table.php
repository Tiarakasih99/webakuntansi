
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accounts', function (Blueprint $table) {

            // Tambahkan kolom category_id
            $table->unsignedBigInteger('category_id')
                  ->nullable()
                  ->after('name');

            // Tambahkan foreign key
            $table->foreign('category_id')
                  ->references('id')
                  ->on('account_categories')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
