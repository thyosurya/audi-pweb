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
        Schema::create('laporan_pendapatan', function (Blueprint $table) {
            $table->integer('id_laporan', false, true)->length(11)->primary();
            $table->integer('id_pembayaran', false, true)->length(11);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('pembayaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pendapatan');
    }
};