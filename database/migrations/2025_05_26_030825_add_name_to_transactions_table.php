<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaction', function (Blueprint $table) {
            // Tambah kolom "total" bertipe decimal (precision 15, scale 2) setelah kolom pembayaran
            $table->string('name')
                ->after('invoice')
                ->default('unknown');
        });
    }

    public function down()
    {
        Schema::table('transaction', function (Blueprint $table) {
            // Hapus kolom "total" saat rollback
            $table->dropColumn('name');
        });
    }
};
