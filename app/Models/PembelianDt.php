<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDt extends Model
{
    use HasFactory;

    protected $table = 'tbpembeliandetil';
    protected $primaryKey = 'kode_pembdetil';


    protected $fillable = [
        'kode_pembelian',
        'nama_barang',
        'jumlah_barang',
        'satuan_barang',
        'deskripsi_barang',
        'harga_satuan_barang',
        'harga_total_barang_sbd',
        'persen_diskon_barang',
        'rupiah_diskon_barang',
        'harga_total_barang_std',
    ];
}
