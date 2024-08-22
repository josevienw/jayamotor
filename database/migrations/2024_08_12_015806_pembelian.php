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
        Schema::create('tbpembelian', function (Blueprint $table) {
            $table->string('kode_pembelian')->primary();
            $table->date('tanggal_pembelian');
            $table->string('kode_supplier')->nullable();
            $table->string('deskripsi_pembelian')->nullable();
            $table->integer('total_pembelian_sb');
            $table->integer('persen_diskon_pembelian')->nullable();
            $table->integer('rupiah_diskon_pembelian')->nullable();
            $table->integer('persen_ppn_pembelian')->nullable();
            $table->integer('rupiah_ppn_pembelian')->nullable();
            $table->integer('persen_biayalain_pembelian')->nullable();
            $table->integer('rupiah_biayalain_pembelian')->nullable();
            $table->integer('total_pembelian_st');
            $table->integer('pembulatan_pembelian')->nullable();
            $table->integer('jumlah_bayar_pembelian');
            $table->boolean('status_pembelian');
            $table->timestamps();

        });
        Schema::create('tbpembeliandetil', function (Blueprint $table) {
            $table->id('kode_pembdetil')->autoIncrement();
            $table->string('kode_pembelian');
            $table->string('nama_barang');
            $table->integer('jumlah_barang')->nullable();
            $table->string('satuan_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->integer('harga_satuan_barang');
            $table->integer('harga_total_barang_sbd');
            $table->integer('persen_diskon_barang')->nullable();
            $table->integer('rupiah_diskon_barang')->nullable();
            $table->integer('harga_total_barang_std');
            $table->timestamps();
        });
        Schema::create('temptbpembelian', function (Blueprint $table) {
            $table->string('kode_pembelian')->primary();
            $table->date('tanggal_pembelian');
            $table->string('kode_supplier')->nullable();
            $table->string('deskripsi_pembelian')->nullable();
            $table->integer('total_pembelian_sb');
            $table->integer('persen_diskon_pembelian')->nullable();
            $table->integer('rupiah_diskon_pembelian')->nullable();
            $table->integer('persen_ppn_pembelian')->nullable();
            $table->integer('rupiah_ppn_pembelian')->nullable();
            $table->integer('persen_biayalain_pembelian')->nullable();
            $table->integer('rupiah_biayalain_pembelian')->nullable();
            $table->integer('total_pembelian_st');
            $table->integer('pembulatan_pembelian')->nullable();
            $table->integer('jumlah_bayar_pembelian');
            $table->boolean('status_pembelian');
            $table->timestamps();

        });
        Schema::create('temptbpembeliandetil', function (Blueprint $table) {
            $table->id('kode_pembdetil')->autoIncrement();
            $table->string('kode_pembelian');
            $table->string('nama_barang');
            $table->integer('jumlah_barang')->nullable();
            $table->string('satuan_barang')->nullable();
            $table->string('deskripsi_barang')->nullable();
            $table->integer('harga_satuan_barang');
            $table->integer('harga_total_barang_sbd');
            $table->integer('persen_diskon_barang')->nullable();
            $table->integer('rupiah_diskon_barang')->nullable();
            $table->integer('harga_total_barang_std');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbpembelian');
        Schema::dropIfExists('tbpembeliandetil');
        Schema::dropIfExists('temptbpembelian');
        Schema::dropIfExists('temptbpembeliandetil');
    }
};
