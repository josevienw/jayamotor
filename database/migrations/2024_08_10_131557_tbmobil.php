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
        Schema::create('tbmobil', function (Blueprint $table) {
            $table->string('kode_mobil')->primary();
            $table->string('kb_mobil')->nullable();
            $table->string('nama_mobil')->nullable();
            $table->string('deskripsi_mobil')->nullable();
            $table->string('kode_perusahaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbmobil');
    }
};
