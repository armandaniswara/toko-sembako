<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaction', function (Blueprint $table) {

            $table->decimal('cost', 15, 2)->default(0)->after('total');

        });
    }

    /**
     * Reverse the migrations.
     * Menghapus kolom 'cost' jika migrasi di-rollback.
     */
    public function down(): void
    {
        Schema::table('transaction', function (Blueprint $table) {
            // Ini adalah operasi kebalikan dari method up()
            // untuk memastikan migrasi bisa di-rollback dengan aman.
            $table->dropColumn('cost');
        });
    }
};
