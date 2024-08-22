<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'tbpembelian';
    protected $primaryKey = 'kode_pembelian';

    public $incrementing = false; // Set to false if your primary key is not auto-incrementing
    protected $keyType = 'string'; // Set to 'string' if your primary key is a string

    protected $fillable = [
        'kode_pembelian',
        'tanggal_pembelian',
        'kode_supplier',
        'deskripsi_pembelian',
        'total_pembelian_sb',
        'persen_diskon_pembelian',
        'rupiah_diskon_pembelian',
        'persen_ppn_pembelian',
        'rupiah_ppn_pembelian',
        'persen_biayalain_pembelian',
        'rupiah_biayalain_pembelian',
        'total_pembelian_st',
        'pembulatan_pembelian',
        'jumlah_bayar_pembelian',
        'status_pembelian'
    ];
}
