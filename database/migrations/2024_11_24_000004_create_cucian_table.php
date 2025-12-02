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
        Schema::create('cucian', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cucian')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_pesanan');
            $table->string('no_pesanan', 20);
            $table->string('status_cucian', 20);
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cucian');
    }
};