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
        Schema::create('penyimpanan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_penyimpanan')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_cucian');
            $table->date('tanggal_simpan');
            $table->string('lokasi_rak', 20);
            $table->timestamps();

            $table->foreign('id_cucian')->references('id_cucian')->on('cucian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyimpanan');
    }
};