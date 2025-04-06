<?php

namespace App\Http\Controllers\AdminMaster;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // profil
    public function profil()
    {
        // menampilkan data user yang sedang login tanpa relasi 
        $data = User::where('id', Auth::user()->id)->first();

        //  menampilkan judul dan deskripsi halaman
        $pageTitle = 'Profil';
        $pageDescription = 'Menampilkan informasi hak akses admin master: alamat email dan kata sandi';

        return  view('AdminMaster.profil.index', compact(
            'pageTitle',
            'pageDescription',
            'data',
        ));
    }

    // update profil
    public function update(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6',
        ]);

        try {
            // Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            // Update password if provided
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            // Save user changes
            $user->save();

            return redirect()->back()->with('success', '<b>Berhasil!</b> Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

}
