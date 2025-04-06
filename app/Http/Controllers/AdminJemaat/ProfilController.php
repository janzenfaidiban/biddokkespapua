<?php

namespace App\Http\Controllers\AdminJemaat;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jemaat;
use App\Models\Kartukeluarga;
use App\Models\Anggotakeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // profil
    public function profil()
    {
        $data = User::with('klasis.wilayah','jemaat.klasis.wilayah')->where('id', Auth::user()->id)->first();
        $wilayah = null;
        $klasis = null;

        // Get the logged-in user details
        $loggedUser = Jemaat::where('user_id', auth()->id())->first();

        // Count total families
        $totalKeluarga = Kartukeluarga::where('jemaat_id', $loggedUser->id)->count();

        
        // Get family IDs associated with the logged-in user
        $keluargaIds = Kartukeluarga::where('jemaat_id', $loggedUser->id)->pluck('no_kk');

        // Count total family members
        $totalAnggotaKeluarga = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->count();
        $anggotaKeluargaLakiLaki = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->where('jenis_kelamin', 'Laki-Laki')->count();
        $anggotaKeluargaPerempuan = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->where('jenis_kelamin', 'Perempuan')->count();

        foreach($data->jemaat as $jemaat);
        {
            $wilayah = $jemaat->klasis->wilayah->wilayah;
            $klasis = $jemaat->klasis->nama_klasis;
        }

        $pageTitle = 'Profil Jemaat';
        $pageDescription = 'Menampilkan informasi umum jemaat, link media sosial, dan hak akses untuk operator/admin jemaat (alamat email dan kata sandi)';

        return  view('AdminJemaat.profil.index', compact('pageTitle','pageDescription','data','wilayah','klasis', 'totalKeluarga','totalAnggotaKeluarga','anggotaKeluargaLakiLaki','anggotaKeluargaPerempuan'));
    }

    // print
    public function print()
    {
        $data = User::with('klasis.wilayah','jemaat.klasis.wilayah')->where('id', Auth::user()->id)->first();
        $wilayah = null;
        $klasis = null;

        // Get the logged-in user details
        $loggedUser = Jemaat::where('user_id', auth()->id())->first();

        // Count total families
        $totalKeluarga = Kartukeluarga::where('jemaat_id', $loggedUser->id)->count();

        
        // Get family IDs associated with the logged-in user
        $keluargaIds = Kartukeluarga::where('jemaat_id', $loggedUser->id)->pluck('no_kk');
        
        // Count total family members
        $totalAnggotaKeluarga = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->count();
        $anggotaKeluargaLakiLaki = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->where('jenis_kelamin', 'Laki-Laki')->count();
        $anggotaKeluargaPerempuan = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->where('jenis_kelamin', 'Perempuan')->count();
        

        foreach($data->jemaat as $jemaat);
        {
            $wilayah = $jemaat->klasis->wilayah->wilayah;
            $klasis = $jemaat->klasis->nama_klasis;
        }

        // pageTitle
        $pageTitle = 'Profil Jemaat';
        $pageDescription = '...';

        return  view('AdminJemaat.profil.print', compact('pageTitle','pageDescription','data','wilayah','klasis', 'totalKeluarga','totalAnggotaKeluarga','anggotaKeluargaLakiLaki','anggotaKeluargaPerempuan'));

    }

    // update profil
    public function update(Request $request)
    {
        // Validate request data
        $request->validate([
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6',

            'fotoGereja' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fotoPendeta' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            if ($request->hasFile('fotoGereja')) {
                if ($user->fotoGereja) {
                    Storage::disk('public')->delete($user->fotoGereja);
                }
                $user->fotoGereja = $request->file('fotoGereja')->store('uploads/adminjemaat/fotoGereja', 'public');
            }

            if ($request->hasFile('fotoPendeta')) {
                if ($user->fotoPendeta) {
                    Storage::disk('public')->delete($user->fotoPendeta);
                }
                $user->fotoPendeta = $request->file('fotoPendeta')->store('uploads/adminjemaat/fotoPendeta', 'public');
            }

            // Handle PDF file uploads and delete old files
            if ($request->hasFile('fileStrukturOrganisasi')) {
                if ($user->fileStrukturOrganisasi) {
                    Storage::disk('public')->delete($user->fileStrukturOrganisasi);
                }
                $user->fileStrukturOrganisasi = $request->file('fileStrukturOrganisasi')->store('uploads/adminjemaat/fileStrukturOrganisasi', 'public');
            }

            if ($request->hasFile('fileSaranaPrasarana')) {
                if ($user->fileSaranaPrasarana) {
                    Storage::disk('public')->delete($user->fileSaranaPrasarana);
                }
                $user->fileSaranaPrasarana = $request->file('fileSaranaPrasarana')->store('uploads/adminjemaat/fileSaranaPrasarana', 'public');
            }

            // Save user changes
            $user->save();

            return redirect()->back()->with('success', '<b>Berhasil!</b> Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    // Delete fotoGereja
    public function deleteFotoGereja($id)
    {
        $user = User::findOrFail($id);

        if ($user->fotoGereja) {
            Storage::disk('public')->delete($user->fotoGereja);
            $user->fotoGereja = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto Gereja berhasil dihapus.');
    }

    // Delete fotoPendeta
    public function deleteFotoPendeta($id)
    {
        $user = User::findOrFail($id);

        if ($user->fotoPendeta) {
            Storage::disk('public')->delete($user->fotoPendeta);
            $user->fotoPendeta = null;
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
