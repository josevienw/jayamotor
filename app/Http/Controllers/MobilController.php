<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the largest kode_user from the database
        $lastMobil = Mobil::selectRaw('max(kode_mobil) as KodeTerbesar')->first();

        $KodeTerbesar = $lastMobil->KodeTerbesar;

        if ($KodeTerbesar !== null) {
            // Extract the numeric part and increment it
            $urutan = (int) substr($KodeTerbesar, 3, 3);
            $urutan++;

            // Construct the new user code
            $huruf = "MOB";
            $newMobilCode = $huruf . sprintf("%03s", $urutan);
        } else {
            // If no users exist, start with 'MOB001'
            $huruf = "MOB";
            $newMobilCode = $huruf . '001';
        }

        // Retrieve all mobil from the database
        $datamobil = Mobil::select('tbmobil.*', 'tbperusahaan.nama_perusahaan')
                ->leftJoin('tbperusahaan', 'tbmobil.kode_perusahaan', '=', 'tbperusahaan.kode_perusahaan')
                ->get();
        $dataperusahaan = Perusahaan::all();

        // Return the view with the data
        return view('admin.mobil.mobil')->with([
            'datamobil' => $datamobil,
            'dataperusahaan' => $dataperusahaan,
            'newMobilCode' => $newMobilCode,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_mobil' => 'required|unique:tbmobil,kode_mobil',
            'kb_mobil' => 'nullable|string|max:255',
            'nama_mobil' => 'nullable|string|max:255',
            'deskripsi_mobil' => 'nullable|string|max:255',
            'kode_perusahaan' => 'nullable|string|max:255',
        ]);

        // Create a new mobil instance and save it to the database
        Mobil::create([
            'kode_mobil' => $request->kode_mobil,
            'kb_mobil' => $request->kb_mobil,
            'nama_mobil' => $request->nama_mobil,
            'deskripsi_mobil' => $request->deskripsi_mobil,
            'kode_perusahaan' => $request->kode_perusahaan,
        ]);

        return redirect()->route('mobil')->with('success', 'Data mobil berhasil dimasukkan!');
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
    public function show(Mobil $mobil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobil $mobil)
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
            'edit_kode_mobil' => 'required',
            'edit_kb_mobil' => 'nullable|string|max:255',
            'edit_nama_mobil' => 'nullable|string|max:255',
            'edit_deskripsi_mobil' => 'nullable|string|max:255',
            'edit_kode_perusahaan' => 'nullable|string|max:255',
        ]);

        $kode_mobil = $request->input('edit_kode_mobil');

        // Find the mobil by kode_mobil
        $mobil = Mobil::where('kode_mobil', $kode_mobil)->firstOrFail();

        // Update the mobil's data
        $mobil->kb_mobil = $request->input('edit_kb_mobil');
        $mobil->nama_mobil = $request->input('edit_nama_mobil');
        $mobil->deskripsi_mobil = $request->input('edit_deskripsi_mobil');
        $mobil->kode_perusahaan = $request->input('edit_kode_perusahaan');

        // Save the updated data to the database
        $mobil->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data mobil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_mobil)
    {
        // Find the perusahaan by kode_mobil
        $mobil = Mobil::where('kode_mobil', $kode_mobil)->first();

        if (!$mobil) {
            return redirect()->back()->with('error', 'Data mobil tidak ditemukan!');
        }

        // Delete the mobil
        $mobil->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data mobil berhasil dihapus!');
    }
}
