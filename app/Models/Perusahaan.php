<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Perusahaan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbperusahaan';
    protected $primaryKey = 'kode_perusahaan';

    public $incrementing = false; // Set to false if your primary key is not auto-incrementing
    protected $keyType = 'string'; // Set to 'string' if your primary key is a string

    protected $fillable = [
        'kode_perusahaan',
        'nama_perusahaan',
        'deskripsi_perusahaan',
        'alamat_perusahaan',
        'kontak_perusahaan',
    ];
}
