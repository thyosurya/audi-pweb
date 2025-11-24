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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->integer('id_pembayaran', false, true)->length(11)->primary();
            $table->integer('id_penyimpanan', false, true)->length(11);
            $table->integer('id_pesanan', false, true)->length(11);
            $table->decimal('harga_per_jenis_cucian', 10, 2);
            $table->date('tanggal_pengambilan')->nullable();
            $table->string('metode_pembayaran', 20);
            $table->timestamps();

            $table->foreign('id_penyimpanan')->references('id_penyimpanan')->on('penyimpanan')->onDelete('cascade');
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};