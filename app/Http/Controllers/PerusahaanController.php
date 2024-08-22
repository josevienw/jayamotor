<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the largest kode_user from the database
        $lastPerusahaan = Perusahaan::selectRaw('max(kode_perusahaan) as KodeTerbesar')->first();

        $KodeTerbesar = $lastPerusahaan->KodeTerbesar;

        if ($KodeTerbesar !== null) {
            // Extract the numeric part and increment it
            $urutan = (int) substr($KodeTerbesar, 4, 3);
            $urutan++;

            // Construct the new user code
            $huruf = "PRSH";
            $newPerusahaanCode = $huruf . sprintf("%03s", $urutan);
        } else {
            // If no users exist, start with 'PRSH001'
            $huruf = "PRSH";
            $newPerusahaanCode = $huruf . '001';
        }

        // Retrieve all perusahaan from the database
        $dataperusahaan = Perusahaan::all();

        // Return the view with the data
        return view('admin.perusahaan.perusahaan')->with([
            'dataperusahaan' => $dataperusahaan,
            'newPerusahaanCode' => $newPerusahaanCode,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_perusahaan' => 'required|unique:tbperusahaan,kode_perusahaan',
            'nama_perusahaan' => 'required|string|max:255',
            'deskripsi_perusahaan' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string|max:255',
            'kontak_perusahaan' => 'nullable|string|max:255',
        ]);

        // Create a new perusahaan instance and save it to the database
        Perusahaan::create([
            'kode_perusahaan' => $request->kode_perusahaan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'kontak_perusahaan' => $request->kontak_perusahaan,
        ]);

        return redirect()->route('perusahaan')->with('success', 'Data perusahaan berhasil dimasukkan!');
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
    public function show(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'edit_kode_perusahaan' => 'required|string|max:255',
            'edit_nama_perusahaan' => 'required|string|max:255',
            'edit_deskripsi_perusahaan' => 'nullable|string|max:255',
            'edit_alamat_perusahaan' => 'nullable|string|max:255',
            'edit_kontak_perusahaan' => 'nullable|string|max:255',
        ]);

        $kode_perusahaan = $request->input('edit_kode_perusahaan');

        // Find the perusahaan by kode_perusahaan
        $perusahaan = Perusahaan::where('kode_perusahaan', $kode_perusahaan)->firstOrFail();

        // Update the perusahaan's data
        $perusahaan->nama_perusahaan = $request->input('edit_nama_perusahaan');
        $perusahaan->deskripsi_perusahaan = $request->input('edit_deskripsi_perusahaan');
        $perusahaan->alamat_perusahaan = $request->input('edit_alamat_perusahaan');
        $perusahaan->kontak_perusahaan = $request->input('edit_kontak_perusahaan');

        // Save the updated data to the database
        $perusahaan->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data perusahaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_perusahaan)
    {
        // Find the perusahaan by kode_perusahaan
        $perusahaan = Perusahaan::where('kode_perusahaan', $kode_perusahaan)->first();

        if (!$perusahaan) {
            return redirect()->back()->with('error', 'Data perusahaan tidak ditemukan!');
        }

        // Delete the perusahaan
        $perusahaan->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data perusahaan berhasil dihapus!');
    }
}
