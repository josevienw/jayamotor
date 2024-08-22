<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the largest kode_user from the database
        $lastUser = User::selectRaw('max(kode_user) as KodeTerbesar')->first();

        $KodeTerbesar = $lastUser->KodeTerbesar;

        if ($KodeTerbesar !== null) {
            // Extract the numeric part and increment it
            $urutan = (int) substr($KodeTerbesar, 4, 3);
            $urutan++;

            // Construct the new user code
            $huruf = "USER";
            $newUserCode = $huruf . sprintf("%03s", $urutan);
        } else {
            // If no users exist, start with 'USER001'
            $huruf = "USER";
            $newUserCode = $huruf . '001';
        }

        // Retrieve all users from the database
        $datauser = User::all();

        // Return the view with the data
        return view('admin.users.users')->with([
            'datauser' => $datauser,
            'newUserCode' => $newUserCode, // Pass the generated kode_user to the view if needed
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_user' => 'required|unique:users,kode_user',
            'email_user' => 'required|email|unique:users,email_user',
            'nama_user' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user instance and save it to the database
        User::create([
            'kode_user' => $request->kode_user,
            'email_user' => $request->email_user,
            'nama_user' => $request->nama_user,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        return redirect()->route('pengguna')->with('success', 'Data pengguna berhasil dimasukkan!');
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
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
            'edit_kode_user' => 'required|string|max:255',
            'edit_email_user' => 'required|email|max:255',
            'edit_nama_user' => 'required|string|max:255',
            'edit_password' => 'nullable|string|min:8', // Password is optional, but must be at least 8 characters if provided
        ]);

        $kode_user = $request->input('edit_kode_user');

        // Find the user by kode_user
        $pengguna = User::where('kode_user', $kode_user)->firstOrFail();

         // Check if the user exists
        if (!$pengguna) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan!');
        }


        // Update the user's data
        $pengguna->email_user = $request->input('edit_email_user');
        $pengguna->nama_user = $request->input('edit_nama_user');

        // Only update the password if a new one is provided
        if ($request->filled('edit_password')) {
            $pengguna->password = bcrypt($request->input('edit_password'));
        }

        // Save the updated data to the database
        $pengguna->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_user)
    {
        // Find the user by kode_user
        $pengguna = User::where('kode_user', $kode_user)->first();

        if (!$pengguna) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan!');
        }

        // Delete the user
        $pengguna->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }
}
