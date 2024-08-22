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
        Schema::create('tbperusahaan', function (Blueprint $table) {
            $table->string('kode_perusahaan')->primary();
            $table->string('nama_perusahaan');
            $table->string('deskripsi_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('kontak_perusahaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbperusahaan');
    }
};
