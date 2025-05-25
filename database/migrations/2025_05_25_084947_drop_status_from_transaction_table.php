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
        Schema::table('transaction', function (Blueprint $table) {
            // Hapus kolom status
            $table->dropColumn('status');
        });
    }

    public function down()
    {
        Schema::table('transaction', function (Blueprint $table) {
            // Kembalikan kolom status (contoh: varchar, non-nullable)
            $table->string('status')->default('')->after('invoice');
        });
    }
};
