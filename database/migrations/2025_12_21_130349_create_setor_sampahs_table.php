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
        Schema::create('setor_sampah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nasabah_id');
            $table->unsignedBigInteger('sampah_id');
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->decimal('berat', 8,2)->nullable();
            $table->decimal('total_poin', 12,2)->nullable();
            $table->date('tanggal_transaksi');
            $table->timestamps();

            $table->foreign('nasabah_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('sampah_id')->references('id')->on('sampah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setor_sampah');
    }
};
