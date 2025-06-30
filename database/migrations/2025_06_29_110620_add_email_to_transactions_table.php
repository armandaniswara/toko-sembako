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
            // Menambahkan kolom email setelah kolom 'name'.
            // nullable() ditambahkan agar data lama tidak error.
            // Kita juga tambahkan index untuk mempercepat pencarian.
            $table->string('email')->nullable()->after('name')->index();
        });
    }

    public function down(): void
    {
        Schema::table('transaction', function (Blueprint $table) {
            $table->dropIndex(['email']); // Hapus index dulu
            $table->dropColumn('email');
        });
    }
};
