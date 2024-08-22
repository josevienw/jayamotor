<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'tbmobil';
    protected $primaryKey = 'kode_mobil';

    public $incrementing = false; // Set to false if your primary key is not auto-incrementing
    protected $keyType = 'string'; // Set to 'string' if your primary key is a string

    protected $fillable = [
        'kode_mobil',
        'kb_mobil',
        'nama_mobil',
        'deskripsi_mobil',
        'kode_perusahaan',
    ];
}
