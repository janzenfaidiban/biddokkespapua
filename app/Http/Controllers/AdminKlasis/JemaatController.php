<?php

namespace App\Http\Controllers\Adminklasis;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

// models
use App\Models\User;
use App\Models\Klasis;
use App\Models\Jemaat;
use App\Models\Kartukeluarga;

class JemaatController extends Controller
{
    // index
    public function index()
    {

        // mengambil data user yang sedang login
        $user = Auth::user();

        // klasis memiliki relasi dengan user melalui user_id di tabel klasis
        // mengambil data klasis berdasarkan user yang sedang login
        $klasis = Klasis::where('user_id', $user->id)->firstOrFail();

        // ambil data jemaat berdasarkan klasis_id
        $query = Jemaat::where('klasis_id', $klasis->id)
        ->whereNotNull('nama_jemaat')
        ->with(['user', 'keluarga.anggotakeluarga']) // Load relasi user dan keluarga
        ->withCount('keluarga as totalKeluarga') // Hitung total keluarga
        ->withCount('anggotakeluarga as totalAnggotaKeluarga'); // Hitung total anggota keluarga secara langsung

        // Jika ada pencarian
        if ($s = request()->s) {
        $query->where(function($q) use ($s) {
            $q->where('nama_jemaat', 'LIKE', '%' . $s . '%')
            ->orWhereHas('user', function($q2) use ($s) {
                $q2->where('namaPendeta', 'LIKE', '%' . $s . '%');
            });
        });
        }

        // Cek apakah segmen ketiga adalah 'tempat-sampah'
        $isTrashed = request()->segment(3) == 'trash';

        if ($isTrashed) {
            $query = $query->onlyTrashed();
        }

        // Paginasi dan pengurutan
        $datas = $query->orderBy('id', 'desc')->paginate(10);
        $totalData = Jemaat::count();
        $totalDataTrashed = Jemaat::onlyTrashed()->count();

        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Jemaat';
        $pageDescription = 'Menampilkan data jemaat yang terdaftar. Operator atau admin di tingkat klasis dapat melihat detail data setiap jemaat dan melalukan perubahan data. Hak untuk menambah dan menghapus hanya bisa dilakukan pada sisi admin master (hubungi pihak developer).';

        return view('AdminKlasis.jemaat.index', compact(
            'pageTitle', 
            'pageDescription', 
            'datas', 
            'totalData', 
            'totalDataTrashed'
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // show
    public function show($id)
    {

        // mengambil data user yang sedang login
        $user = Auth::user();

        // ambil data klasis dari database
        $klasis = Klasis::all();

        // ambil data jemaat berdasarkan id
        $data = Jemaat::with('user')->findOrFail($id);

        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Detail  Jemaat';
        $pageDescription = 'Halaman detail data jemaat. Menampilkan informasi lengkap tentang jemaat dan user.';

        return view('AdminKlasis.jemaat.form', compact(
            'pageTitle',
            'pageDescription',
            'klasis', 
            'data'
        ));
    }

    // edit
    public function edit($id)
    {

        // mengambil data user yang sedang login
        $user = Auth::user();

        // klasis memiliki relasi dengan user melalui user_id di tabel klasis
        // mengambil data klasis berdasarkan user yang sedang login
        $klasisYangSedangLogin = Klasis::where('user_id', $user->id)->firstOrFail();

        // mengambil data klasis dari database
        $klasis = Klasis::all();

        // mengambil data jemaat berdasarkan id dan memastikan menampilkan jemaat yang memiliki klasis_id sama dengan klasis yang sedang login
        $data = Jemaat::where('klasis_id', $klasisYangSedangLogin->id)->with('user')->findOrFail($id);

        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Ubah Jemaat';
        $pageDescription = 'Halaman ubah data jemaat. Menampilkan form untuk mengedit data jemaat dan user.';

        return view('AdminKlasis.jemaat.form', compact(
            'pageTitle',
            'pageDescription',
            'klasis', 
            'data'
        ));
    }

    // update
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make(
            $request->all(),
            [
                'nama_jemaat' => 'required',
                'klasis_id' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:8',
            ],
            [
                'nama_jemaat.required' => 'Nama jemaat wajib diisi',
                'klasis_id.required' => 'Klasis wajib dipilih',
                'email.required' => 'Email pengguna wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'password.min' => 'Password minimal 6 karakter',
                'fotoGereja' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fotoPendeta' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fileStrukturOrganisasi' => 'nullable|mimes:pdf,xls,xlsx|max:5120', // Allow PDF, Excel (XLS, XLSX), max 5MB
                'fileSaranaPrasarana' => 'nullable|mimes:pdf,xls,xlsx|max:5120', // Allow PDF, Excel (XLS, XLSX), max 5MB
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                DB::beginTransaction();

                // Cari user berdasarkan ID
                $user = User::findOrFail($id);

                // Update email tanpa validasi unik karena bisa diganti
                $user->email = $request->email;
                
                // Update password jika ada perubahan
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }
                
                $user->avatar = 'assets/images/avatar-gereja.png';
                $user->name = $request->nama_jemaat;
                $user->namaPendeta = $request->namaPendeta;

                $user->alamat = $request->alamat;
                $user->profil = $request->profil;

                // media sosial
                $user->instagram = $request->instagram;
                $user->facebook = $request->facebook;
                $user->wa_channel = $request->wa_channel;
                $user->youtube = $request->youtube;
                
                // Proses upload file dan hapus file lama jika ada perubahan fotoGereja
                if ($request->hasFile('fotoGereja')) {
                    if ($user->fotoGereja) {
                        Storage::disk('public')->delete($user->fotoGereja);
                    }
                    $user->fotoGereja = $request->file('fotoGereja')->store('uploads/adminjemaat/fotoGereja', 'public');
                }
                
                // proses upload file and delete file lama 'fotoPendeta'
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
                
                // Simpan perubahan pada user
                $user->save();

                // Perbarui data jemaat terkait
                $jemaat = Jemaat::where('user_id', $user->id)->firstOrFail();
                
                $jemaat->nama_jemaat = $request->nama_jemaat;
                $jemaat->klasis_id = $request->klasis_id;
                
                // Simpan perubahan pada jemaat
                $jemaat->save();

                DB::commit();
                return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data jemaat dan user telah diperbarui'));
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data jemaat dan user gagal diperbarui. Error: ' . $th->getMessage()));
            }
        }
    }

    // Delete fotoGereja
    public function deleteFotoGereja($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->fotoGereja) {
                Storage::disk('public')->delete($user->fotoGereja);
                $user->fotoGereja = null;
                $user->save();
            }

            return redirect()->back()->with('success', 'Foto Gereja berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['danger' => 'Gagal! User tidak ditemukan.']);
        } catch (\Exception $e) {
            \Log::error('Error saat menghapus foto Gereja: ' . $e->getMessage());
            return redirect()->back()->withErrors(['danger' => 'Gagal! Terjadi kesalahan saat menghapus foto Gereja.']);
        }
    }

    // Delete fotoPendeta
    public function deleteFotoPendeta($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->fotoPendeta) {
                Storage::disk('public')->delete($user->fotoPendeta);
                $user->fotoPendeta = null;
                $user->save();
            }

            return redirect()->back()->with('success', 'Foto Pendeta berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['danger' => 'Gagal! User tidak ditemukan.']);
        } catch (\Exception $e) {
            \Log::error('Error saat menghapus foto Pendeta: ' . $e->getMessage());
            return redirect()->back()->withErrors(['danger' => 'Gagal! Terjadi kesalahan saat menghapus foto Pendeta.']);
        }
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
