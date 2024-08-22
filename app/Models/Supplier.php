<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Supplier extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbsupplier';
    protected $primaryKey = 'kode_supplier';

    public $incrementing = false; // Set to false if your primary key is not auto-incrementing
    protected $keyType = 'string'; // Set to 'string' if your primary key is a string

    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'alamat_supplier',
        'kontak_supplier',
    ];
}
