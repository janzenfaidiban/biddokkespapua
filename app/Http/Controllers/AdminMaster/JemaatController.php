<?php

namespace App\Http\Controllers\AdminMaster;

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
        $query = Jemaat::whereNotNull('nama_jemaat')
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
        $pageDescription = 'Mengelola data jemaat: tambah, ubah, dan hapus termasuk mengelola data media sosial dan hak akses setiap jemaat.';

        return view('AdminMaster.jemaat.index', compact(
            'pageTitle', 
            'pageDescription', 
            'datas', 
            'totalData', 
            'totalDataTrashed'
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // create
    public function create()
    {
        // ambil data klasis dari database
        $klasis = Klasis::all();

        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Tambah Jemaat';
        $pageDescription = 'Formulir untuk menambah data jemaat baru. Informasi umum jemaat, informasi media sosial, informasi hak akses.';

        return view('AdminMaster.jemaat.form', compact(
            'pageTitle',
            'pageDescription',
            'klasis'
        ));
    }

    // store
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_jemaat' => 'required',
                'klasis_id' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ],
            [
                'nama_jemaat.required' => 'Nama jemaat wajib diisi',
                'klasis_id.required' => 'Klasis wajib dipilih',
                'email.required' => 'Email pengguna wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 6 karakter',
                'fotoGereja' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fotoPendeta' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fotoSekretarisJemaat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fileStrukturOrganisasi' => 'nullable|mimes:pdf,xls,xlsx|max:5120', // Allow PDF, Excel (XLS, XLSX), max 5MB
                'fileSaranaPrasarana' => 'nullable|mimes:pdf,xls,xlsx|max:5120', // Allow PDF, Excel (XLS, XLSX), max 5MB
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                DB::beginTransaction(); // Mulai transaksi database

                /*
                informasi hak akses di tingkat jemaat dan klasis
                data ini ditambahkan ke tabel user
                */
                $user = new User();

                $user->avatar = 'assets/images/avatar-gereja.png';
                $user->name = $request->nama_jemaat;
                $user->namaPendeta = $request->namaPendeta;
                
                $user->alamat = $request->alamat;
                $user->profil = $request->profil;

                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                
                /*
                media sosial jemaat
                */
                $user->instagram = $request->instagram;
                $user->facebook = $request->facebook;
                $user->wa_channel = $request->wa_channel;
                $user->youtube = $request->youtube;
                
                // proses upload file and delete file lama 'fotoGereja'
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
                
                // proses upload file and delete file lama 'fotoSekretarisJemaat'
                if ($request->hasFile('fotoSekretarisJemaat')) {
                    if ($user->fotoSekretarisJemaat) {
                        Storage::disk('public')->delete($user->fotoSekretarisJemaat);
                    }
                    $user->fotoSekretarisJemaat = $request->file('fotoSekretarisJemaat')->store('uploads/adminjemaat/fotoSekretarisJemaat', 'public');
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

                
                // proses simpan data ke tabel user
                $user->save();

                // proses menambahkan role/peran pengguna sebagai 'adminjemaat'
                $user->assignRole('adminjemaat');

                // Tambah jemaat baru dan hubungkan dengan user
                $jemaat = new Jemaat();

                $jemaat->user_id = $user->id;
                $jemaat->nama_jemaat = $request->nama_jemaat;
                $jemaat->klasis_id = $request->klasis_id;

                // proses simpan data ke tabel jemaat
                $jemaat->save();

                DB::commit(); // Simpan perubahan ke database

                return redirect()->route('adminmaster.jemaat.index')->with(BootstrapAlerts::addSuccess('Berhasil! Data jemaat dan user telah ditambahkan ke database'));
            } catch (\Throwable $th) {
                DB::rollback(); // Batalkan perubahan jika terjadi error
                return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data jemaat dan user gagal ditambahkan ke database. Error: ' . $th->getMessage()));
            }
        }
    }

    // show
    public function show($id)
    {
        // ambil data klasis dari database
        $klasis = Klasis::all();

        // ambil data jemaat berdasarkan id
        $data = Jemaat::with('user')->findOrFail($id);

        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Detail  Jemaat';
        $pageDescription = 'Halaman detail data jemaat. Menampilkan informasi lengkap tentang jemaat dan user.';

        return view('AdminMaster.jemaat.form', compact(
            'pageTitle',
            'pageDescription',
            'klasis', 
            'data'
        ));
    }

    // edit
    public function edit($id)
    {
        $klasis = Klasis::all();
        $data = Jemaat::with('user')->findOrFail($id);

        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Ubah Jemaat';
        $pageDescription = 'Halaman ubah data jemaat. Menampilkan form untuk mengedit data jemaat dan user.';

        return view('AdminMaster.jemaat.form', compact(
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
                'fotoSekretarisJemaat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                
                // proses upload file and delete file lama 'fotoSekretarisJemaat'
                if ($request->hasFile('fotoSekretarisJemaat')) {
                    if ($user->fotoSekretarisJemaat) {
                        Storage::disk('public')->delete($user->fotoSekretarisJemaat);
                    }
                    $user->fotoSekretarisJemaat = $request->file('fotoSekretarisJemaat')->store('uploads/adminjemaat/fotoSekretarisJemaat', 'public');
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

    // destroy
    public function destroy($id)
    {
        try {
            $data = Jemaat::findOrFail($id);
            $data->delete(); // Soft delete jika menggunakan SoftDeletes
            return redirect()->back()->with('success', 'Data jemaat berhasil dipindahkan ke tempat sampah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data jemaat gagal dihapus.');
        }
    }

    // restore | kembalikan data dari softDelete atau ke tabel utama 
    public function restore($id)
    {
        try {
            $data = Jemaat::onlyTrashed()->findOrFail($id);
            $data->restore(); // Mengembalikan data dari soft delete
            return redirect()->back()->with('success', 'Data jemaat berhasil dikembalikan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Data jemaat gagal dikembalikan.');
        }
    }

    // forceDelete | hapus data secara permanen dari tabel jemaat dan user
    // hapus data dari tabel jemaat dan user secara permanen
    public function forceDelete($id)
    {
        try {
            $data = Jemaat::onlyTrashed()->findOrFail($id);

            // saat proses hapus 
            if ($data->user) {
                $user = User::findOrFail($data->user_id);

                // hapus fotoGereja
                if ($user->fotoGereja) {
                    Storage::disk('public')->delete($user->fotoGereja);
                    $user->fotoGereja = null;
                    $user->save();
                }

                // hapus fotoPendeta
                if ($user->fotoPendeta) {
                    Storage::disk('public')->delete($user->fotoPendeta);
                    $user->fotoPendeta = null;
                    $user->save();
                }
    
                // hapus fotoSekretarisJemaat
                if ($user->fotoSekretarisJemaat) {
                    Storage::disk('public')->delete($user->fotoSekretarisJemaat);
                    $user->fotoSekretarisJemaat = null;
                    $user->save();
                }

                // hapus fileStrukturOrganisasi
                if ($user->fileStrukturOrganisasi) {
                    Storage::disk('public')->delete($user->fileStrukturOrganisasi);
                    $user->fileStrukturOrganisasi = null;
                    $user->save();
                }

                // hapus fileSaranaPrasarana
                if ($user->fileSaranaPrasarana) {
                    Storage::disk('public')->delete($user->fileSaranaPrasarana);
                    $user->fileSaranaPrasarana = null;
                    $user->save();
                }

                // Hapus user yang terkait secara permanen
                $data->user->forceDelete();
            }

            // Hapus jemaat secara permanen
            $data->forceDelete();

            return redirect()->back()->with('success', 'Terhapus permanen! Data telah dihapus secara permanen.');
        } catch (\Exception $e) {
            \Log::error('Error saat menghapus jemaat secara permanen: ' . $e->getMessage());
            return redirect()->back()->withErrors(['danger' => '<b>GAGAL!</b> Data jemaat gagal dihapus secara permanen.']);
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

    // Delete fotoSekretarisJemaat
    public function deleteFotoSekretarisJemaat($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->fotoSekretarisJemaat) {
                Storage::disk('public')->delete($user->fotoSekretarisJemaat);
                $user->fotoSekretarisJemaat = null;
                $user->save();
            }

            return redirect()->back()->with('success', 'Foto SekretarisJemaat berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['danger' => 'Gagal! User tidak ditemukan.']);
        } catch (\Exception $e) {
            \Log::error('Error saat menghapus foto SekretarisJemaat: ' . $e->getMessage());
            return redirect()->back()->withErrors(['danger' => 'Gagal! Terjadi kesalahan saat menghapus foto Sekretaris Jemaat.']);
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
