<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDt;
use App\Models\Supplier;
use App\Models\TePembelian;
use App\Models\TePembelianDt;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the largest kode_pembelian from both tables
        $lastPembelian = Pembelian::selectRaw('max(kode_pembelian) as KodeTerbesar')->first();
        $lastTePembelian = TePembelian::selectRaw('max(kode_pembelian) as KodeTerbesar')->first();

        // Ambil KodeTerbesar dari kedua tabel
        $KodeTerbesarPembelian = $lastPembelian->KodeTerbesar;
        $KodeTerbesarTePembelian = $lastTePembelian->KodeTerbesar;

        // Tentukan KodeTerbesar dari kedua tabel
        if ($KodeTerbesarPembelian !== null && $KodeTerbesarTePembelian !== null) {
            $KodeTerbesar = max($KodeTerbesarPembelian, $KodeTerbesarTePembelian);
        } elseif ($KodeTerbesarPembelian !== null) {
            $KodeTerbesar = $KodeTerbesarPembelian;
        } elseif ($KodeTerbesarTePembelian !== null) {
            $KodeTerbesar = $KodeTerbesarTePembelian;
        } else {
            $KodeTerbesar = null;
        }

        if ($KodeTerbesar !== null) {
            // Extract the numeric part and increment it
            $urutan = (int) substr($KodeTerbesar, 4, 5);
            $urutan++;

            // Construct the new code
            $huruf = "PEMB";
            $newPembelianCode = $huruf . sprintf("%05s", $urutan);
        } else {
            // If no records exist in both tables, start with 'MOB001'
            $huruf = "PEMB";
            $newPembelianCode = $huruf . '00001';
        }

        $TempPembelian = TePembelian::all();
        $Pembelian = Pembelian::all();
        
        return view('admin.pembelian.index')->with([
            'newPembelianCode' => $newPembelianCode,
            'TempPembelian' => $TempPembelian,
            'Pembelian' => $Pembelian
        ]);
    }

    public function form($kode_pembelian)
    {
        $temp_kode_pembelian = TePembelian::where('kode_pembelian', $kode_pembelian)->first();
        $kode_pembelian_cek = Pembelian::where('kode_pembelian', $kode_pembelian)->first();

        if (!$temp_kode_pembelian && !$kode_pembelian_cek) {
        TePembelian::create([
            'kode_pembelian' => $kode_pembelian,
            'tanggal_pembelian' => '2024-01-01',
            'total_pembelian_sb' => '0',
            'total_pembelian_st' => '0',
            'jumlah_bayar_pembelian' => '0',
            'status_pembelian' => '0',
        ]);
        }

        // Retrieve all pembelian and tepembelian data
        // $dataPembelian = Pembelian::all();
        // $dataTePembelian = TePembelian::all();

        $dataTePembelianDt = TePembelianDt::where('kode_pembelian', $kode_pembelian)->get();
        $dataTePembelian = TePembelian::where('kode_pembelian', $kode_pembelian)->firstorfail();
        $subtotal = TePembelianDt::where('kode_pembelian', $kode_pembelian) ->sum('harga_total_barang_std');
        $datasupplier = Supplier::all();

        // dd($dataTePembelian);

        return view('admin.pembelian.insertform')->with([
            'datasupplier' => $datasupplier,
            'dataTePembelianDt' => $dataTePembelianDt,
            'dataTePembelian' => $dataTePembelian,
            'kode_pembelian' => $kode_pembelian,
            'subtotal' => $subtotal,
        ]);
    }

    public function editform($kode_pembelian)
    {
        
        $dataPembelianDt = PembelianDt::where('kode_pembelian', $kode_pembelian)->get();
        $dataPembelian = Pembelian::where('kode_pembelian', $kode_pembelian)->firstorfail();
        $subtotal = PembelianDt::where('kode_pembelian', $kode_pembelian) ->sum('harga_total_barang_std');
        $datasupplier = Supplier::all();

        // dd($dataPembelian);

        return view('admin.pembelian.editform')->with([
            'datasupplier' => $datasupplier,
            'dataPembelianDt' => $dataPembelianDt,
            'dataPembelian' => $dataPembelian,
            'kode_pembelian' => $kode_pembelian,
            'subtotal' => $subtotal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_pembelian' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'nullable|string|max:255',
            'satuan_barang' => 'nullable|string|max:255',
            'deskripsi_barang' => 'nullable|string|max:255',
            'harga_satuan_barang' => 'required|string|max:255',
            'harga_total_barang_sbd' => 'required|string|max:255',
            'persen_diskon_barang' => 'nullable|string|max:255',
            'rupiah_diskon_barang' => 'nullable|string|max:255',
            'harga_total_barang_std' => 'required|string|max:255',
            
        ]);

        // Create a new barang instance and save it to the database
        TePembelianDt::create([
            'kode_pembelian' => $request->kode_pembelian,
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'satuan_barang' => $request->satuan_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'harga_satuan_barang' => $request->harga_satuan_barang,
            'harga_total_barang_sbd' => $request->harga_total_barang_sbd,
            'persen_diskon_barang' => $request->persen_diskon_barang,
            'rupiah_diskon_barang' => $request->rupiah_diskon_barang,
            'harga_total_barang_std' => $request->harga_total_barang_std,
        ]);

        return redirect()->route('formpembelian', ['kode_pembelian' => $request->kode_pembelian])->with('success', 'Data barang berhasil dimasukkan!');
    }

    public function editcreate(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_pembelian' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'nullable|string|max:255',
            'satuan_barang' => 'nullable|string|max:255',
            'deskripsi_barang' => 'nullable|string|max:255',
            'harga_satuan_barang' => 'required|string|max:255',
            'harga_total_barang_sbd' => 'required|string|max:255',
            'persen_diskon_barang' => 'nullable|string|max:255',
            'rupiah_diskon_barang' => 'nullable|string|max:255',
            'harga_total_barang_std' => 'required|string|max:255',
            
        ]);

        // Create a new barang instance and save it to the database
        PembelianDt::create([
            'kode_pembelian' => $request->kode_pembelian,
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'satuan_barang' => $request->satuan_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'harga_satuan_barang' => $request->harga_satuan_barang,
            'harga_total_barang_sbd' => $request->harga_total_barang_sbd,
            'persen_diskon_barang' => $request->persen_diskon_barang,
            'rupiah_diskon_barang' => $request->rupiah_diskon_barang,
            'harga_total_barang_std' => $request->harga_total_barang_std,
        ]);

        return redirect()->route('editformpembelian', ['kode_pembelian' => $request->kode_pembelian])->with('success', 'Data barang berhasil dimasukkan!');
    }

    public function draft(Request $request)
    {
        // Validate request data
        $request->validate([
            'kode_pembelian' => 'required|string',
            'tanggal_pembelian' => 'required|date',
            // add other necessary validations
        ]);

        // Update the data in temptbpembelian
        TePembelian::updateOrCreate(
            ['kode_pembelian' => $request->kode_pembelian],
            $request->only([
                'tanggal_pembelian', 'kode_supplier', 'deskripsi_pembelian', 'total_pembelian_sb',
                'persen_diskon_pembelian', 'rupiah_diskon_pembelian', 'persen_ppn_pembelian', 
                'rupiah_ppn_pembelian', 'persen_biayalain_pembelian', 'rupiah_biayalain_pembelian',
                'total_pembelian_st', 'pembulatan_pembelian', 'jumlah_bayar_pembelian', 'status_pembelian'
            ])
        );

        return redirect()->back()->with('success', 'Data berhasil disimpan ke arsip!');
    }

    public function proses(Request $request)
    {
        // Validate request data
        $request->validate([
            'kode_pembelian' => 'required|string',
            'tanggal_pembelian' => 'required|date',
            // add other necessary validations
        ]);

        // Move data from temptbpembelian to tbpembelian
        $tePembelian = TePembelian::where('kode_pembelian', $request->kode_pembelian)->first();
        if ($tePembelian) {
            $pembelian = Pembelian::create($tePembelian->toArray());
            Pembelian::updateOrCreate(
            ['kode_pembelian' => $request->kode_pembelian],
            $request->only([
                'tanggal_pembelian', 'kode_supplier', 'deskripsi_pembelian', 'total_pembelian_sb',
                'persen_diskon_pembelian', 'rupiah_diskon_pembelian', 'persen_ppn_pembelian', 
                'rupiah_ppn_pembelian', 'persen_biayalain_pembelian', 'rupiah_biayalain_pembelian',
                'total_pembelian_st', 'pembulatan_pembelian', 'jumlah_bayar_pembelian', 'status_pembelian'
            ])
        );

            // Move associated detail data
            $tePembelianDts = TePembelianDt::where('kode_pembelian', $request->kode_pembelian)->get();
            foreach ($tePembelianDts as $tePembelianDt) {
                PembelianDt::create($tePembelianDt->toArray());
            }

            // Delete the temp data if needed
            $tePembelian->delete();
            TePembelianDt::where('kode_pembelian', $request->kode_pembelian)->delete();

            return redirect()->route('pembelian')->with('success', 'Data berhasil di proses');
        }

        return redirect()->back()->with('error', 'Data tidak berhasil di proses');
    }

    public function editproses(Request $request)
    {
        // Validate request data
        $request->validate([
            'kode_pembelian' => 'required|string',
            'tanggal_pembelian' => 'required|date',
            // add other necessary validations
        ]);

        // Move data from temptbpembelian to tbpembelian
        $Pembelian = Pembelian::where('kode_pembelian', $request->kode_pembelian)->first();
        if ($Pembelian) {
            Pembelian::updateOrCreate(
            ['kode_pembelian' => $request->kode_pembelian],
            $request->only([
                'tanggal_pembelian', 'kode_supplier', 'deskripsi_pembelian', 'total_pembelian_sb',
                'persen_diskon_pembelian', 'rupiah_diskon_pembelian', 'persen_ppn_pembelian', 
                'rupiah_ppn_pembelian', 'persen_biayalain_pembelian', 'rupiah_biayalain_pembelian',
                'total_pembelian_st', 'pembulatan_pembelian', 'jumlah_bayar_pembelian', 'status_pembelian'
            ])
        );
            return redirect()->route('pembelian')->with('success', 'Data berhasil di proses');
        }

        return redirect()->back()->with('error', 'Data tidak berhasil di proses');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'edit_kode_pembdetil' => 'required|string|max:255',
            'edit_kode_pembelian' => 'required|string|max:255',
            'edit_nama_barang' => 'required|string|max:255',
            'edit_jumlah_barang' => 'nullable|string|max:255',
            'edit_satuan_barang' => 'nullable|string|max:255',
            'edit_deskripsi_barang' => 'nullable|string|max:255',
            'edit_harga_satuan_barang' => 'required|string|max:255',
            'edit_harga_total_barang_sbd' => 'required|string|max:255',
            'edit_persen_diskon_barang' => 'nullable|string|max:255',
            'edit_rupiah_diskon_barang' => 'nullable|string|max:255',
            'edit_harga_total_barang_std' => 'required|string|max:255',
        ]);

        $kode_pembdetil = $request->input('edit_kode_pembdetil');

        // Find the barang by kode_pembdetil
        $barang = TePembelianDt::where('kode_pembdetil', $kode_pembdetil)->firstOrFail();

        // Update the barang's data
        $barang->kode_pembelian = $request->input('edit_kode_pembelian');
        $barang->nama_barang = $request->input('edit_nama_barang');
        $barang->jumlah_barang = $request->input('edit_jumlah_barang');
        $barang->satuan_barang = $request->input('edit_satuan_barang');
        $barang->deskripsi_barang = $request->input('edit_deskripsi_barang');
        $barang->harga_satuan_barang = $request->input('edit_harga_satuan_barang');
        $barang->harga_total_barang_sbd = $request->input('edit_harga_total_barang_sbd');
        $barang->persen_diskon_barang = $request->input('edit_persen_diskon_barang');
        $barang->rupiah_diskon_barang = $request->input('edit_rupiah_diskon_barang');
        $barang->harga_total_barang_std = $request->input('edit_harga_total_barang_std');

        // Save the updated data to the database
        $barang->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data barang berhasil diperbarui!');
    }

    public function editupdate(Request $request)
    {
        $request->validate([
            'edit_kode_pembdetil' => 'required|string|max:255',
            'edit_kode_pembelian' => 'required|string|max:255',
            'edit_nama_barang' => 'required|string|max:255',
            'edit_jumlah_barang' => 'nullable|string|max:255',
            'edit_satuan_barang' => 'nullable|string|max:255',
            'edit_deskripsi_barang' => 'nullable|string|max:255',
            'edit_harga_satuan_barang' => 'required|string|max:255',
            'edit_harga_total_barang_sbd' => 'required|string|max:255',
            'edit_persen_diskon_barang' => 'nullable|string|max:255',
            'edit_rupiah_diskon_barang' => 'nullable|string|max:255',
            'edit_harga_total_barang_std' => 'required|string|max:255',
        ]);

        $kode_pembdetil = $request->input('edit_kode_pembdetil');

        // Find the barang by kode_pembdetil
        $barang = PembelianDt::where('kode_pembdetil', $kode_pembdetil)->firstOrFail();

        // Update the barang's data
        $barang->kode_pembelian = $request->input('edit_kode_pembelian');
        $barang->nama_barang = $request->input('edit_nama_barang');
        $barang->jumlah_barang = $request->input('edit_jumlah_barang');
        $barang->satuan_barang = $request->input('edit_satuan_barang');
        $barang->deskripsi_barang = $request->input('edit_deskripsi_barang');
        $barang->harga_satuan_barang = $request->input('edit_harga_satuan_barang');
        $barang->harga_total_barang_sbd = $request->input('edit_harga_total_barang_sbd');
        $barang->persen_diskon_barang = $request->input('edit_persen_diskon_barang');
        $barang->rupiah_diskon_barang = $request->input('edit_rupiah_diskon_barang');
        $barang->harga_total_barang_std = $request->input('edit_harga_total_barang_std');

        // Save the updated data to the database
        $barang->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_pembdetil)
    {
        // Find the perusahaan by kode_pembdetil
        $barang = TePembelianDt::where('kode_pembdetil', $kode_pembdetil)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Data barang tidak ditemukan!');
        }

        // Delete the barang
        $barang->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data barang berhasil dihapus!');
    }

    public function editdestroy($kode_pembdetil)
    {
        // Find the perusahaan by kode_pembdetil
        $barang = PembelianDt::where('kode_pembdetil', $kode_pembdetil)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Data barang tidak ditemukan!');
        }

        // Delete the barang
        $barang->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data barang berhasil dihapus!');
    }
    
    public function tempformdestroy(Request $request, $kode_pembelian)
    {
        $tePembelian = TePembelian::where('kode_pembelian', $kode_pembelian)->first();

        if($tePembelian){
            $tePembelian->delete();
            TePembelianDt::where('kode_pembelian', $request->kode_pembelian)->delete();

            return redirect()->route('pembelian')->with('success', 'Data berhasil di hapus');;
        }
        return redirect()->back()->with('error', 'Data tidak berhasil dihapus!');
    }

    public function formdestroy(Request $request, $kode_pembelian)
    {
        $Pembelian = Pembelian::where('kode_pembelian', $kode_pembelian)->first();

        if($Pembelian){
            $Pembelian->delete();
            PembelianDt::where('kode_pembelian', $request->kode_pembelian)->delete();

            return redirect()->route('pembelian')->with('success', 'Data berhasil di hapus');;
        }
        return redirect()->back()->with('error', 'Data tidak berhasil dihapus!');
    }
}
