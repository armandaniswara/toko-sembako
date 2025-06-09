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
        Schema::table('transaction_detail', function (Blueprint $table) {
            $table->foreign('invoice', 'fk_transaction_invoice')
                ->references('invoice')
                ->on('transaction')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('transaction_detail', function (Blueprint $table) {
            $table->foreign('sku', 'fk_transaction_sku')
                ->references('sku')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_detail', function (Blueprint $table) {
            $table->dropForeign('fk_transaction_invoice');
            $table->dropForeign('fk_transaction_sku');
        });
    }
};
