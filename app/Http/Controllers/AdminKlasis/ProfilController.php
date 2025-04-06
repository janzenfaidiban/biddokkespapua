<?php

namespace App\Http\Controllers\AdminKlasis;

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
        $data = User::with('klasis.wilayah','jemaat.klasis.wilayah')->where('id',Auth::user()->id)->first();
        $wilayah = null;
        $klasis = null;
        if(Auth::user()->hasRole('adminklasis'))
        {
            foreach($data->klasis as $klasis);
            {
                $wilayah = $klasis->wilayah->wilayah;
            }

        }

        if(Auth::user()->hasRole('adminklasis'))
        {
            foreach($data->klasis as $klasis);
            {
                $wilayah = $klasis->wilayah->wilayah;
            }

        }   

        //  menampilkan judul dan deskripsi halaman
        $pageTitle = 'Profil Klasis';
        $pageDescription = 'Menampilkan informasi umum klasis, link media sosial, dan hak akses untuk operator/admin jemaat (alamat email dan kata sandi)';

        return  view('AdminKlasis.profil.index', compact(
            'pageTitle',
            'pageDescription',
            'data',
            'wilayah',
            'klasis'
        ));
    }

    

    // update profil
    public function update(Request $request)
    {
        // Validate request data
        $request->validate([
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6',

            'fotoKantor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fotoKetuaKlasis' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fileStrukturOrganisasi' => 'nullable|mimes:pdf,xls,xlsx|max:5120', // Allow PDF, Excel (XLS, XLSX), max 5MB
            'fileSaranaPrasarana' => 'nullable|mimes:pdf,xls,xlsx|max:5120', // Allow PDF, Excel (XLS, XLSX), max 5MB

        ]);

        try {
            // Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            // Update user fields
            $user->email = $request->email;
            $user->namaPendeta = $request->namaPendeta;

            $user->instagram = $request->instagram;
            $user->facebook = $request->facebook;
            $user->wa_channel = $request->wa_channel;
            $user->youtube = $request->youtube;

            // Update password if provided
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            // Handle image file uploads and delete old files
            if ($request->hasFile('fotoKantor')) {
                if ($user->fotoKantor) {
                    Storage::disk('public')->delete($user->fotoKantor);
                }
                $user->fotoKantor = $request->file('fotoKantor')->store('uploads/adminklasis/fotoKantor', 'public');
            }

            if ($request->hasFile('fotoKetuaKlasis')) {
                if ($user->fotoKetuaKlasis) {
                    Storage::disk('public')->delete($user->fotoKetuaKlasis);
                }
                $user->fotoKetuaKlasis = $request->file('fotoKetuaKlasis')->store('uploads/adminklasis/fotoKetuaKlasis', 'public');
            }

            // Handle PDF file uploads and delete old files
            if ($request->hasFile('fileStrukturOrganisasi')) {
                if ($user->fileStrukturOrganisasi) {
                    Storage::disk('public')->delete($user->fileStrukturOrganisasi);
                }
                $user->fileStrukturOrganisasi = $request->file('fileStrukturOrganisasi')->store('uploads/adminklasis/fileStrukturOrganisasi', 'public');
            }

            if ($request->hasFile('fileSaranaPrasarana')) {
                if ($user->fileSaranaPrasarana) {
                    Storage::disk('public')->delete($user->fileSaranaPrasarana);
                }
                $user->fileSaranaPrasarana = $request->file('fileSaranaPrasarana')->store('uploads/adminklasis/fileSaranaPrasarana', 'public');
            }

            // Save user changes
            $user->save();

            return redirect()->back()->with('success', '<b>Berhasil!</b> Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    // Delete fotoKantor
    public function deletefotoKantor($id)
    {
        $user = User::findOrFail($id);

        if ($user->fotoKantor) {
            Storage::disk('public')->delete($user->fotoKantor);
            $user->fotoKantor = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto Gereja berhasil dihapus.');
    }

    // Delete fotoKetuaKlasis
    public function deletefotoKetuaKlasis($id)
    {
        $user = User::findOrFail($id);

        if ($user->fotoKetuaKlasis) {
            Storage::disk('public')->delete($user->fotoKetuaKlasis);
            $user->fotoKetuaKlasis = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto Pendeta berhasil dihapus.');
    }

    // Delete fileStrukturOrganisasi
    public function deleteFileStrukturOrganisasi($id)
    {
        $user = User::findOrFail($id);

        if ($user->fileStrukturOrganisasi) {
            Storage::disk('public')->delete($user->fileStrukturOrganisasi);
            $user->fileStrukturOrganisasi = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'File Struktur Organisasi berhasil dihapus.');
    }

    // Delete fileSaranaPrasarana
    public function deleteFileSaranaPrasarana($id)
    {
        $user = User::findOrFail($id);

        if ($user->fileSaranaPrasarana) {
            Storage::disk('public')->delete($user->fileSaranaPrasarana);
            $user->fileSaranaPrasarana = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'File Sarana Prasarana berhasil dihapus.');
    }

}
