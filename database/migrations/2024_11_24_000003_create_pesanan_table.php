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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->string('nama_pelanggan', 100);
            $table->string('no_hp', 15);
            $table->string('jenis_cucian', 50);
            $table->decimal('berat', 10, 2);
            $table->date('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};