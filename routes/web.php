<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin/index');
});

Route::get('/admin/pengguna', [UserController::class, 'index'])->name('pengguna');
Route::post('/admin/penggunainsert', [UserController::class, 'create'])->name('penggunainsert');
Route::post('/admin/penggunaupdate', [UserController::class, 'update'])->name('penggunaupdate');
Route::delete('/admin/penggunadelete/{kode_user}', [UserController::class, 'destroy'])->name('penggunadelete');

Route::get('/admin/supplier', [SupplierController::class, 'index'])->name('supplier');
Route::post('/admin/supplierinsert', [SupplierController::class, 'create'])->name('supplierinsert');
Route::post('/admin/supplierupdate', [SupplierController::class, 'update'])->name('supplierupdate');
Route::delete('/admin/supplierdelete/{kode_supplier}', [SupplierController::class, 'destroy'])->name('supplierdelete');

Route::get('/admin/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan');
Route::post('/admin/perusahaaninsert', [PerusahaanController::class, 'create'])->name('perusahaaninsert');
Route::post('/admin/perusahaanupdate', [PerusahaanController::class, 'update'])->name('perusahaanupdate');
Route::delete('/admin/perusahaandelete/{kode_perusahaan}', [PerusahaanController::class, 'destroy'])->name('perusahaandelete');

Route::get('/admin/mobil', [MobilController::class, 'index'])->name('mobil');
Route::post('/admin/mobilinsert', [MobilController::class, 'create'])->name('mobilinsert');
Route::post('/admin/mobilupdate', [MobilController::class, 'update'])->name('mobilupdate');
Route::delete('/admin/mobildelete/{kode_mobil}', [MobilController::class, 'destroy'])->name('mobildelete');

Route::get('/admin/pembelian', [PembelianController::class, 'index'])->name('pembelian');
Route::get('/admin/pembelian/form/{kode_pembelian}', [PembelianController::class, 'form'])->name('formpembelian');
Route::post('/admin/pembelian/formbrginsert', [PembelianController::class, 'create'])->name('pembelianbrginsert');
Route::post('/admin/pembelian/formbrgupdate', [PembelianController::class, 'update'])->name('pembelianbrgupdate');
Route::post('/admin/pembelian/formdraft', [PembelianController::class, 'draft'])->name('pembeliandraft');
Route::post('/admin/pembelian/formproses', [PembelianController::class, 'proses'])->name('pembelianproses');
Route::delete('/admin/pembelian/formbrgdelete/{kode_pembdetil}', [PembelianController::class, 'destroy'])->name('pembelianbrgdelete');

Route::get('/admin/pembelian/edit/form/{kode_pembelian}', [PembelianController::class, 'editform'])->name('editformpembelian');
Route::post('/admin/pembelian/editformbrginsert', [PembelianController::class, 'editcreate'])->name('editpembelianbrginsert');
Route::post('/admin/pembelian/editformbrgupdate', [PembelianController::class, 'editupdate'])->name('editpembelianbrgupdate');
Route::post('/admin/pembelian/editformproses', [PembelianController::class, 'editproses'])->name('editpembelianproses');
Route::delete('/admin/pembelian/editformbrgdelete/{kode_pembdetil}', [PembelianController::class, 'editdestroy'])->name('editpembelianbrgdelete');

Route::delete('/admin/pembelian/formdelete/temp/{kode_pembelian}', [PembelianController::class, 'tempformdestroy'])->name('temppembeliandelete');
Route::delete('/admin/pembelian/formdelete/{kode_pembelian}', [PembelianController::class, 'formdestroy'])->name('pembeliandelete');