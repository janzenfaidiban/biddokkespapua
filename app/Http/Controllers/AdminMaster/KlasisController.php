<?php

namespace App\Http\Controllers\AdminMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Klasis;
use App\Models\Wilayah;

use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KlasisController extends Controller
{
    // index
    public function index()
    {
        // Membuat query untuk mendapatkan data Klasis yang tidak null
        $query = Klasis::whereNotNull('nama_klasis');

        // Memeriksa apakah ada parameter pencarian 's' dalam request
        if ($s = request()->s) {
            // Memfilter query untuk menyertakan hanya data yang sesuai dengan pencarian
            $query->where('nama_klasis', 'LIKE', '%' . $s . '%');
        }

        // Mengurutkan dan melakukan paginasi
        $datas = $query->orderBy('id', 'desc')->paginate(10);

        // Menghitung total data
        $totalData = $query->count();

        // Memeriksa apakah segmen ketiga dalam URL adalah 'trash'
        $isTrashed = request()->segment(3) == 'trash';

        if ($isTrashed) {
            $query = $query->onlyTrashed(); // Mengambil hanya data yang telah dihapus secara soft delete
            $datas = $query->orderBy('id', 'desc')->paginate(10);
        }

        // Menghitung total data yang terhapus
        $totalDataTrashed = Klasis::onlyTrashed()->count();

        $pageTitle = 'Klasis';
        $pageDescription = 'Mengelola data klasis: tambah, ubah, dan hapus termasuk mengelola data media sosial dan hak akses setiap klasis.';

        // Mengembalikan tampilan dengan data yang diperlukan
        return view('AdminMaster.klasis.index', compact('pageTitle','pageDescription', 'datas', 'totalData', 'totalDataTrashed'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // create
    public function create()
    {
        // ambil data wilayah dari database
        $wilayah = Wilayah::all();

        // menampilkan teks untuk judul dan deskripsi halaman
        $pageTitle = 'Tambah Klasis';
        $pageDescription = 'Formulir untuk menambah data klasis baru. Informasi umum klasis, informasi media sosial, informasi hak akses.';

        return view('AdminMaster.klasis.form', compact(
            'pageTitle',
            'pageDescription',
            'wilayah'
        ));
    }

    // store
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'wilayah_id' => 'required|integer',
                'nama_klasis' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ],
            [
                'wilayah_id.required' => 'Wilayah harus dipilih.',
                'wilayah_id.integer' => 'Wilayah harus dalam format angka.',
                'nama_klasis.required' => 'Nama klasis wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Kata sandi minimal 8 karakter.',
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
                $user->name = $request->nama_klasis;
                
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
                
                // proses upload file and delete file lama 'fotoKantor'
                if ($request->hasFile('fotoKantor')) {
                    if ($user->fotoKantor) {
                        Storage::disk('public')->delete($user->fotoKantor);
                    }
                    $user->fotoKantor = $request->file('fotoKantor')->store('uploads/adminklasis/fotoKantor', 'public');
                }
                
                // proses upload file and delete file lama 'fotoKetuaKlasis'
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
                
                // proses simpan data ke tabel user
                $user->save();

                // proses menambahkan role/peran pengguna sebagai 'adminjemaat'
                $user->assignRole('adminklasis');

                // Tambah klasis baru dan hubungkan dengan user
                $klasis = new Klasis();

                $klasis->user_id = 61;
                $klasis->wilayah_id = $request->wilayah_id;
                $klasis->nama_klasis = $request->nama_klasis;

                // proses simpan data ke tabel klasis
                $klasis->save();

                DB::commit(); // Simpan perubahan ke database

                return redirect()->route('adminmaster.klasis.index')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah ditambahkan ke database'));

            } catch (\Throwable $th) {
                DB::rollback(); // Batalkan perubahan jika terjadi error
                return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data gagal ditambahkan ke database. Error: ' . $th->getMessage()));
            }
        }

    }

    // show
    public function show($id)
    {
        // ambil data wilayah dari database
        $wilayah = Wilayah::all();

        // ambil data klasis dari database berdasarkan id
        $data = Klasis::with('user')->findOrFail($id);

        // menampilkan teks untuk judul dan deskripsi halaman
        $pageTitle = 'Detail Klasis';
        $pageDescription = 'Halaman detail data klasis. Menampilkan informasi lengkap tentang klasis dan user.';

        return view('AdminMaster.klasis.form', compact(
            'pageTitle',
            'pageDescription',
            'wilayah', 
            'data'
        ));
    }

    // edit
    public function edit($id)
    {
        // ambil data wilayah dari database
        $wilayah = Wilayah::all();

        // ambil data klasis dari database berdasarkan id
        $data = Klasis::with('user')->findOrFail($id);

        // menampilkan teks untuk judul dan deskripsi halaman
        $pageTitle = 'Ubah Klasis';
        $pageDescription = 'Halaman ubah data jemaat. Menampilkan form untuk mengedit data jemaat dan user.';

        return view('AdminMaster.klasis.form', compact(
            'pageTitle',
            'pageDescription',
            'wilayah', 
            'data'
        ));
    }

    // update
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'wilayah_id' => 'required|integer',
                'nama_klasis' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:8',
            ],
            [
                'wilayah_id.required' => 'Wilayah harus dipilih.',
                'wilayah_id.integer' => 'Wilayah harus dalam format angka.',
                'nama_klasis.required' => 'Nama klasis wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.min' => 'Kata sandi minimal 8 karakter.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->name = $request->nama_klasis;
            $user->alamat = $request->alamat;
            $user->profil = $request->profil;
            $user->email = $request->email;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->instagram = $request->instagram;
            $user->facebook = $request->facebook;
            $user->wa_channel = $request->wa_channel;
            $user->youtube = $request->youtube;

            // Update fotoKantor
            if ($request->hasFile('fotoKantor')) {
                if ($user->fotoKantor) {
                    Storage::disk('public')->delete($user->fotoKantor);
                }
                $user->fotoKantor = $request->file('fotoKantor')->store('uploads/adminklasis/fotoKantor', 'public');
            }

            // Update fotoKetuaKlasis
            if ($request->hasFile('fotoKetuaKlasis')) {
                if ($user->fotoKetuaKlasis) {
                    Storage::disk('public')->delete($user->fotoKetuaKlasis);
                }
                $user->fotoKetuaKlasis = $request->file('fotoKetuaKlasis')->store('uploads/adminklasis/fotoKetuaKlasis', 'public');
            }

            // Update fileStrukturOrganisasi
            if ($request->hasFile('fileStrukturOrganisasi')) {
                if ($user->fileStrukturOrganisasi) {
                    Storage::disk('public')->delete($user->fileStrukturOrganisasi);
                }
                $user->fileStrukturOrganisasi = $request->file('fileStrukturOrganisasi')->store('uploads/adminklasis/fileStrukturOrganisasi', 'public');
            }

            // Update fileSaranaPrasarana
            if ($request->hasFile('fileSaranaPrasarana')) {
                if ($user->fileSaranaPrasarana) {
                    Storage::disk('public')->delete($user->fileSaranaPrasarana);
                }
                $user->fileSaranaPrasarana = $request->file('fileSaranaPrasarana')->store('uploads/adminklasis/fileSaranaPrasarana', 'public');
            }

            $user->save();

            // Update klasis
            $klasis = Klasis::where('user_id', $user->id)->firstOrFail();
            $klasis->wilayah_id = $request->wilayah_id;
            $klasis->nama_klasis = $request->nama_klasis;
            $klasis->save();

            DB::commit();

            return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data berhasil diperbarui.'));

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data gagal diperbarui. Error: ' . $th->getMessage()));
        }
    }


    // destroy
    public function destroy($id)
    {
        try {
            $data = Klasis::findOrFail($id);
            $data->delete(); // Soft delete jika menggunakan SoftDeletes
            return redirect()->back()->with('success', 'Data berhasil dipindahkan ke tempat sampah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data gagal dihapus.');
        }
    }

    // restore | kembalikan data dari softDelete atau ke tabel utama 
    public function restore($id)
    {
        try {
            // Mengambil data yang telah dihapus (soft deleted) berdasarkan ID
            $data = Klasis::onlyTrashed()->findOrFail($id);

            $data->restore(); // Mengembalikan data dari soft delete

            return redirect()->back()->with('success', 'Data berhasil dikembalikan.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Data gagal dikembalikan.');
        }
    }

    // forceDelete | hapus data secara permanen
    // hapus data secara permanen dari tabel jemaat dan user
    public function forceDelete($id)
    {
        try {
            $data = Klasis::onlyTrashed()->findOrFail($id);

            // saat proses hapus 
            if ($data->user) {
                $user = User::findOrFail($data->user_id);

                // hapus fotoKantor
                if ($user->fotoKantor) {
                    Storage::disk('public')->delete($user->fotoKantor);
                    $user->fotoKantor = null;
                    $user->save();
                }

                // hapus fotoKetuaKlasis
                if ($user->fotoKetuaKlasis) {
                    Storage::disk('public')->delete($user->fotoKetuaKlasis);
                    $user->fotoKetuaKlasis = null;
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
            return redirect()->back()->withErrors(['danger' => '<b>GAGAL!</b> Data gagal dihapus secara permanen.']);
        }
    }

    // Delete fotoKantor
    public function deletefotoKantor($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->fotoKantor) {
                Storage::disk('public')->delete($user->fotoKantor);
                $user->fotoKantor = null;
                $user->save();
            }

            return redirect()->back()->with('success', 'Foto berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['danger' => 'Gagal! User tidak ditemukan.']);
        } catch (\Exception $e) {
            \Log::error('Error saat menghapus foto: ' . $e->getMessage());
            return redirect()->back()->withErrors(['danger' => 'Gagal! Terjadi kesalahan saat menghapus foto.']);
        }
    }

    // Delete fotoKetuaKlasis
    public function deletefotoKetuaKlasis($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->fotoKetuaKlasis) {
                Storage::disk('public')->delete($user->fotoKetuaKlasis);
                $user->fotoKetuaKlasis = null;
                $user->save();
            }

            return redirect()->back()->with('success', 'Foto berhasil dihapus.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['danger' => 'Gagal! User tidak ditemukan.']);
        } catch (\Exception $e) {
            \Log::error('Error saat menghapus foto: ' . $e->getMessage());
            return redirect()->back()->withErrors(['danger' => 'Gagal! Terjadi kesalahan saat menghapus foto.']);
        }
    }

    // Delete fileStrukturOrganisasi
    public function deleteFileStrukturOrganisasi($id)
    {
        // mengambil data user berdasarkan id
        // jika tidak ada data user maka tampilkan pesan error
        $user = User::findOrFail($id);

        // jika ada fileStrukturOrganisasi yang diupload
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

        // mengambil data user berdasarkan id
        // jika tidak ada data user maka tampilkan pesan error
        $user = User::findOrFail($id);

        // jika ada fileSaranaPrasarana yang diupload
        if ($user->fileSaranaPrasarana) {
            Storage::disk('public')->delete($user->fileSaranaPrasarana);
            $user->fileSaranaPrasarana = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'File Sarana Prasarana berhasil dihapus.');
    }


}
