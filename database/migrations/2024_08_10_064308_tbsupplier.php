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
        Schema::create('tbsupplier', function (Blueprint $table) {
            $table->string('kode_supplier')->primary();
            $table->string('nama_supplier');
            $table->string('alamat_supplier')->nullable();
            $table->string('kontak_supplier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbsupplier');
    }
};
