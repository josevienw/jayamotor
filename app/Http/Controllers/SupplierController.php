<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all supplier from the database
        $datasupplier = Supplier::all();

        // Return the view with the data
        return view('admin.supplier.supplier')->with([
            'datasupplier' => $datasupplier,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_supplier' => 'required|unique:tbsupplier,kode_supplier',
            'nama_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'nullable|string|max:255',
            'kontak_supplier' => 'nullable|string|max:255',
        ]);

        // Create a new supplier instance and save it to the database
        Supplier::create([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat_supplier' => $request->alamat_supplier,
            'kontak_supplier' => $request->kontak_supplier,
        ]);

        return redirect()->route('supplier')->with('success', 'Data supplier berhasil dimasukkan!');
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
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
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
            'edit_kode_supplier' => 'required|string|max:255',
            'edit_nama_supplier' => 'required|string|max:255',
            'edit_alamat_supplier' => 'nullable|string|max:255',
            'edit_kontak_supplier' => 'nullable|string|max:255',
        ]);

        $kode_supplier = $request->input('edit_kode_supplier');

        // Find the supplier by kode_supplier
        $supplier = Supplier::where('kode_supplier', $kode_supplier)->firstOrFail();

        // Update the supplier's data
        $supplier->nama_supplier = $request->input('edit_nama_supplier');
        $supplier->alamat_supplier = $request->input('edit_alamat_supplier');
        $supplier->kontak_supplier = $request->input('edit_kontak_supplier');

        // Save the updated data to the database
        $supplier->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data supplier berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_supplier)
    {
        // Find the supplier by kode_supplier
        $supplier = Supplier::where('kode_supplier', $kode_supplier)->first();

        if (!$supplier) {
            return redirect()->back()->with('error', 'Data supplier tidak ditemukan!');
        }

        // Delete the supplier
        $supplier->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data supplier berhasil dihapus!');
    }
}
