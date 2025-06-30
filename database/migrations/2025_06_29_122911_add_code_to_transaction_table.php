<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

    /**
     * Run the migrations.
     */
{
    public function up(): void
    {
        Schema::table('transaction', function (Blueprint $table) {
            // 1. Buat kolom 'code' dengan tipe data STRING (varchar)
            $table->string('code')->nullable()->after('id');

            // 2. Buat foreign key secara manual ke kolom 'code' di tabel 'shipment_status'
            //    Ini akan menghubungkan transaction.code dengan shipment_status.code
            $table->foreign('code')->references('code')->on('shipment_status');
        });
    }

    public function down(): void
    {
        Schema::table('transaction', function (Blueprint $table) {
            $table->dropForeign(['code']);
            $table->dropColumn('code');
        });
    }
};
