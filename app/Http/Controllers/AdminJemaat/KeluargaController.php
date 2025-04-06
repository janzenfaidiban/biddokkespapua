<?php

namespace App\Http\Controllers\AdminJemaat;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Hubungankeluarga;
use App\Models\Jemaat;
use App\Models\Kartukeluarga;
use App\Models\Anggotakeluarga;

// master models
use App\Models\Golongandarah;
use App\Models\Statusbaptis;
use App\Models\Statussidi;
use App\Models\Intra;
use App\Models\Statuspernikahan;
use App\Models\Gelardepan;
use App\Models\Gelarbelakang;
use App\Models\Jenispekerjaan;
use App\Models\Statusdomisili;
use App\Models\Penyandangcacat;
use App\Models\Pendidikanterakhir;
use App\Models\Suku;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use DateTime;

class KeluargaController extends Controller
{
    // index
    public function index()
    {
        // Create a query to get Kartukeluarga with related Jemaat, Klasis, Wilayah, and Anggotakeluarga where no_kk is not null
        $query = Kartukeluarga::with([
            'jemaat.klasis.wilayah',
            'anggotakeluarga' => function ($query) {
                $query->where('hubungan_keluarga_id', 1);
            }
        ])->whereNotNull('no_kk');

        // Check if there is a search parameter 's' in the request
        if ($s = request()->s) {
            $query->where(function ($q) use ($s) {
                $q->where('no_kk', 'LIKE', '%' . $s . '%')
                    ->orWhereHas('anggotakeluarga', function ($query) use ($s) {
                        $query->where('nama_depan', 'LIKE', '%' . $s . '%')
                            ->orWhere('nama_tengah', 'LIKE', '%' . $s . '%')
                            ->orWhere('nama_belakang', 'LIKE', '%' . $s . '%');
                    });
            });
        }

        // Get the role of the authenticated user
        $role = Auth::user()->roles->pluck('name')->implode(', ');

        // Filter records by logged-in user's jemaat_id
        $query->whereHas('jemaat', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });

        // Check if the third segment of the request URL is 'tempat-sampah'
        $isTrashed = request()->segment(3) == 'tempat-sampah';

        if ($isTrashed) {
            $query = $query->onlyTrashed(); // Retrieve only soft-deleted records
        }

        // Paginate results
        $datas = $query->orderBy('id', 'desc')->paginate(10);

        // Calculate total data
        $totalData = Kartukeluarga::whereNotNull('no_kk')
            ->whereHas('jemaat', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->count();

        // Get the logged-in user's Jemaat data
        $loggedUser = Jemaat::where('user_id', auth()->user()->id)->first();
        
        // Get family IDs associated with the logged-in user
        $keluargaIds = Kartukeluarga::where('jemaat_id', $loggedUser->id)->pluck('no_kk');

        // Count total family members
        $totalAnggotaKeluarga = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->count();
        $anggotaKeluargaLakiLaki = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->where('jenis_kelamin', 'Laki-Laki')->count();
        $anggotaKeluargaPerempuan = Anggotakeluarga::whereIn('no_kk', $keluargaIds)->where('jenis_kelamin', 'Perempuan')->count();

        // Calculate total trashed data
        $totalDataTrashed = Kartukeluarga::onlyTrashed()
            ->whereHas('jemaat', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->count();

            $pageTitle = 'Keluarga & Anggota Keluarga';
            $pageDescription = 'Daftar keluarga berdasarkan kepala keluarga di dalam jemaat.';

        return view('AdminJemaat.keluarga.index', compact('pageTitle','pageDescription','datas','totalData','totalDataTrashed','loggedUser','totalAnggotaKeluarga','anggotaKeluargaLakiLaki','anggotaKeluargaPerempuan'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }



    // create
    public function create($jemaat_id)
    {


        // Mengambil data jemaat beserta data klasis yang terkait berdasarkan id jemaat
        $jemaat = Jemaat::with('klasis')->where('id', $jemaat_id)->first();
        
        // Melakukan loop untuk menghasilkan nomor KK acak yang belum ada di database
        do {
        // Menghasilkan nomor acak dengan panjang 10 digit
        $randomNumber = mt_rand(1000000000, 9999999999);
        // Memeriksa apakah nomor acak tersebut sudah ada di tabel Kartukeluarga
        } while (Kartukeluarga::where('no_kk', $randomNumber)->exists());

        // Menyimpan nomor KK baru yang dihasilkan
        $newNoKk = $randomNumber;

        // Mengambil semua data dari tabel Kartukeluarga
        $keluarga = Kartukeluarga::get();

        return view('AdminJemaat.keluarga.form', compact('jemaat', 'newNoKk'));

    }

    // store
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'no_kk' => 'required|unique:kartukeluargas,no_kk',
                'keterangan' => 'nullable|string',
            ],
            [
                'no_kk.required' => 'Nomor KK wajib diisi',
                'no_kk.unique' => 'Nomor KK sudah terdaftar',
            ]
        );

        if ($validator->fails()) {
          
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        
        } else {
            try {
                // Simpan data ke dalam tabel Kartukeluarga
                $kartukeluarga = new Kartukeluarga();
                $kartukeluarga->no_kk = $request->no_kk;
                $kartukeluarga->jemaat_id = $request->jemaat_id;
                $kartukeluarga->keterangan = $request->keterangan;
                $kartukeluarga->save();
                
                return redirect()->route('adminjemaat.keluarga.index')->with('success', 'Data keluarga berhasil disimpan.');
            
            } catch (\Throwable $th) {
            
                return redirect()->route('adminjemaat.keluarga.index')->with('error', 'Gagal! Data keluarga gagal disimpan.');
        
            }
      
        }
  
    }

    // show
    public function show($id)
    {

        // Mengambil data jemaat beserta data klasis yang terkait berdasarkan id jemaat
        $jemaat = Jemaat::with('klasis')->where('id', $_GET['jemaat_id'])->first();

        // Mengambil semua data dari tabel Kartukeluarga
        $item = Kartukeluarga::where('id', $id)->first();

        return view('AdminJemaat.keluarga.form', compact('item', 'jemaat'));
    }

    // edit
    public function edit($id)
    {

        // Mengambil data jemaat beserta data klasis yang terkait berdasarkan id jemaat
        $jemaat = Jemaat::with('klasis')->where('id', $_GET['jemaat_id'])->first();

        $query = Kartukeluarga::with(['jemaat.klasis'])->where('id', $id);

        $item = $query->orderBy('id', 'asc')->first();

        return view('AdminJemaat.keluarga.form', compact('item', 'jemaat'));
    }

 
  







    public function update(Request $request, $id)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'no_kk' => 'required|unique:kartukeluargas,no_kk,' . $id,
                'keterangan' => 'nullable|string',
            ],
            [
                'no_kk.required' => 'Nomor Kartu Keluarga wajib diisi',
                'no_kk.unique' => 'Nomor Kartu Keluarga sudah terdaftar',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                // Update data di tabel Kartukeluarga
                $kartukeluarga = Kartukeluarga::findOrFail($id);
                $kartukeluarga->no_kk = $request->no_kk;
                $kartukeluarga->jemaat_id = $request->jemaat_id;
                $kartukeluarga->keterangan = $request->keterangan;
                $kartukeluarga->save();

                // Update data di tabel Anggotakeluarga berdasarkan anggota_keluarga_id
                $anggotaKeluarga = Anggotakeluarga::where('no_kk', $kartukeluarga->no_kk)->first();
                if ($anggotaKeluarga) {
                    $anggotaKeluarga->no_kk = $request->no_kk;
                    $anggotaKeluarga->hubungan_keluarga_id = 1; // 1 = Kepala Keluarga
                    $anggotaKeluarga->save();
                }

                return redirect()->back()->with('success', 'Data keluarga berhasil diperbarui.');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Gagal! Data keluarga gagal diperbarui.');
            }
        }
    }









    // destroy
    public function destroy($id)
    {
        try {
            $kartukeluarga = Kartukeluarga::findOrFail($id);
            $kartukeluarga->delete(); // Soft delete jika menggunakan SoftDeletes
            return redirect()->back()->with('success', 'Data keluarga berhasil dipindahkan ke tempat sampah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data keluarga gagal dihapus.');
        }
    }







    // restore | kembalikan data dari softDelete atau ke tabel utama 
    public function restore($id)
    {
        try {
            $kartukeluarga = Kartukeluarga::onlyTrashed()->findOrFail($id);
            $kartukeluarga->restore(); // Mengembalikan data dari soft delete
            return redirect()->back()->with('success', 'Data keluarga berhasil dikembalikan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Data keluarga gagal dikembalikan.');
        }
    }






  // forceDelete | hapus permanen dari database
  public function forceDelete($id)
  {
      try {
          $kartukeluarga = Kartukeluarga::withTrashed()->findOrFail($id);
          $kartukeluarga->forceDelete(); // Hapus permanen dari database
          return redirect()->back()->with('danger', 'Data keluarga berhasil dihapus secara permanen.');
      } catch (\Throwable $th) {
          return redirect()->back()->with('danger', '<b>GAGAL!</b>  Data keluarga gagal dihapus secara permanen.');
      }
  }









/*============================================================ ANGGOTA KELUARGA ==================================================================*/ 







    // kelurga/{no_kk}/anggota
    // menampilkan data anggota keluarga berdasarkan no_kk
    public function anggota($no_kk)
    {
        $query = Anggotakeluarga::with(['keluarga.jemaat.klasis', 'hubungankeluarga'])
            ->where('no_kk', $no_kk)
            ->whereNotNull('nama_depan'); // Fixing incorrect NULL check

        // Check if there is a search parameter 's' in the request
        if ($s = request()->s) {
            $query->where(function ($q) use ($s) {
                $q->where('nama_depan', 'LIKE', '%' . $s . '%')
                    ->orWhere('nama_tengah', 'LIKE', '%' . $s . '%')
                    ->orWhere('nama_belakang', 'LIKE', '%' . $s . '%');
            });
        }

        $totalData = $query->count();

        // Check if the fourth segment of the request URL is 'tempat-sampah'
        $isTrashed = request()->segment(5) == 'tempat-sampah';

        if ($isTrashed) {
            $datas = $query->onlyTrashed()->orderBy('id', 'asc')->get();
        } else {
            $datas = $query->orderBy('id', 'asc')->get();
        }      

        $no_kk = $no_kk;
        $query->where('no_kk', $no_kk);

        $keluarga = Kartukeluarga::where('no_kk', $no_kk)
            ->with('jemaat.klasis')
            ->first();

        $totalDataTrashed = $query->onlyTrashed()->count();

        // Hitung hari menuju ulang tahun untuk setiap anggota keluarga
        foreach ($datas as $data) {
            if ($data->tanggal_lahir) {
                $tglLahir = new DateTime($data->tanggal_lahir);
                $tahunSekarang = date('Y');
                $tglUltahTahunIni = new DateTime("$tahunSekarang-" . $tglLahir->format('m-d'));

                if ($tglUltahTahunIni < new DateTime()) {
                    $tglUltahTahunIni->modify('+1 year');
                }

                $data->hari_menuju_ultah = (new DateTime())->diff($tglUltahTahunIni)->days;
            } else {
                $data->hari_menuju_ultah = null; // Jika tidak ada tanggal lahir, set null
            }
        }

        return view('AdminJemaat.keluarga.anggota.index', compact('datas', 'no_kk', 'keluarga', 'totalData', 'totalDataTrashed'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }







    // keluarga/anggota/{no_kk}/tambah
    // menampilkan formulir tambah anggota
    public function anggotaCreate($no_kk)
    {


        try {
            $keluarga = Kartukeluarga::where('no_kk', $no_kk)->firstOrFail();

            $hubunganKeluarga = Hubungankeluarga::all();

            $golonganDarah = Golongandarah::all();
            $statusBaptis = Statusbaptis::all();
            $statusSidi = Statussidi::all();
            $intra = Intra::all();
            $statusPernikahan = Statuspernikahan::all();
            $gelarDepan = Gelardepan::orderBy('gelardepan', 'asc')->get();
            $gelarBelakang = Gelarbelakang::orderBy('gelarbelakang', 'asc')->get();
            $jenisPekerjaan = Jenispekerjaan::orderBy('jenispekerjaan', 'asc')->get();
            $statusDomisili = Statusdomisili::all();
            $penyandangCacat = Penyandangcacat::orderBy('penyandangcacat', 'asc')->get();
            $pendidikanTerakhir = Pendidikanterakhir::orderBy('pendidikanterakhir', 'asc')->get();

            $suku = Suku::orderBy('suku', 'asc')->get();
            
            return view('AdminJemaat.keluarga.anggota.form', compact(
                'keluarga', 
                'hubunganKeluarga',
                'golonganDarah',
                'statusBaptis',
                'statusSidi',
                'intra',
                'statusPernikahan',
                'gelarDepan',
                'gelarBelakang',
                'jenisPekerjaan',
                'statusDomisili',
                'penyandangCacat',
                'pendidikanTerakhir',
                'suku',
            ));

        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Data keluarga tidak ditemukan.');
        }
    }






    // keluarga/anggota/store
    public function anggotaStore(Request $request)
    {
        // dd('anggota keluarga store');

        // Validasi input
        $request->validate([
            'no_kk' => 'required|string|max:16',
            'hubungan_keluarga_id' => 'required|exists:hubungankeluargas,id',
            'nama_depan' => 'required|string|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            // 'nomor_hp' => ['regex:/^(\+62|0)[8123456789][0-9]{8,12}$/'],
            // 'email' => 'email',
        ]);

        try {
            // Cek apakah sudah ada kepala keluarga (hubungan_keluarga_id = 1) di dalam keluarga (no_kk)
            if ($request->hubungan_keluarga_id == 1) {
                $existingKepalaKeluarga = AnggotaKeluarga::where('no_kk', $request->no_kk)
                    ->where('hubungan_keluarga_id', 1)
                    ->exists();

                if ($existingKepalaKeluarga) {
                    return redirect()->back()->with('danger', '<b>GAGAL!</b> Kepala Keluarga telah ditentukan. Setiap keluarga hanya boleh memiliki satu kepala keluarga.');
                }
            }

            // Simpan data ke database
            $anggota = new AnggotaKeluarga();
            $anggota->no_kk = $request->no_kk;
            $anggota->hubungan_keluarga_id = $request->hubungan_keluarga_id;
            $anggota->nama_depan = $request->nama_depan;
            $anggota->nama_tengah = $request->nama_tengah ?? null; // Menghindari error jika null
            $anggota->nama_belakang = $request->nama_belakang ?? null;

            $anggota->jenis_kelamin = $request->jenis_kelamin ?? null;
            $anggota->tempat_lahir = $request->tempat_lahir ?? null;
            $anggota->tanggal_lahir = $request->tanggal_lahir ?? null;
            
            $anggota->golongan_darah_id = $request->golongan_darah_id ?? null;
            $anggota->status_baptis_id = $request->status_baptis_id ?? null;
            $anggota->status_sidi_id = $request->status_sidi_id ?? null;
            $anggota->intra_id = $request->intra_id ?? null;
            $anggota->status_pernikahan_id = $request->status_pernikahan_id ?? null;
            $anggota->gelar_depan_id = $request->gelar_depan_id ?? null;
            $anggota->gelar_belakang_id = $request->gelar_belakang_id ?? null;
            $anggota->jenis_pekerjaan_id = $request->jenis_pekerjaan_id ?? null;
            $anggota->status_domisili_id = $request->status_domisili_id ?? null;
            $anggota->penyandang_cacat_id = $request->penyandang_cacat_id ?? null;
            $anggota->pendidikan_terakhir_id = $request->pendidikan_terakhir_id ?? null;
            $anggota->suku_id = $request->suku_id ?? null;
            
            // informasi kontak
            $anggota->nomor_hp = $request->nomor_hp ?? null;
            $anggota->email = $request->email ?? null;
            
            $anggota->save();

            // Jika berhasil, tampilkan alert sukses
            return redirect()->route('adminjemaat.keluarga.anggota.index', $anggota->no_kk)
                ->with('success', 'Data anggota keluarga baru sudah ditambahkan.');
        
        } catch (\Exception $e) {
            // Jika gagal, tampilkan alert error dengan pesan error
            return redirect()->back()->with('error', '<b>GAGAL!</b> Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }








    // keluarga/anggota/edit
    public function anggotaEdit($id)
    {


        try {
            // Cari anggota berdasarkan ID
            $anggota = AnggotaKeluarga::findOrFail($id);

            // Ambil data keluarga berdasarkan nomor KK
            $keluarga = Kartukeluarga::where('no_kk', $anggota->no_kk)->firstOrFail();

            // Ambil daftar hubungan keluarga
            $hubunganKeluarga = Hubungankeluarga::all();




            $golonganDarah = Golongandarah::all();
            $statusBaptis = Statusbaptis::all();
            $statusSidi = Statussidi::all();
            $intra = Intra::all();
            $statusPernikahan = Statuspernikahan::all();
            $gelarDepan = Gelardepan::orderBy('gelardepan', 'asc')->get();
            $gelarBelakang = Gelarbelakang::orderBy('gelarbelakang', 'asc')->get();
            $jenisPekerjaan = Jenispekerjaan::orderBy('jenispekerjaan', 'asc')->get();
            $statusDomisili = Statusdomisili::all();
            $penyandangCacat = Penyandangcacat::orderBy('penyandangcacat', 'asc')->get();
            $pendidikanTerakhir = Pendidikanterakhir::orderBy('pendidikanterakhir', 'asc')->get();
            $suku = Suku::orderBy('suku', 'asc')->get();

            // Tampilkan form edit dengan data yang telah diambil
            return view('AdminJemaat.keluarga.anggota.form', compact(
                'anggota', 
                'keluarga', 
                'hubunganKeluarga',
                'golonganDarah',
                'statusBaptis',
                'statusSidi',
                'intra',
                'statusPernikahan',
                'gelarDepan',
                'gelarBelakang',
                'jenisPekerjaan',
                'statusDomisili',
                'penyandangCacat',
                'pendidikanTerakhir',
                'suku',
            ));

            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', '<b>GAGAL!</b> Data anggota keluarga tidak ditemukan.');
        }
        
    }








    // keluarga/anggota/update
    public function anggotaUpdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'no_kk' => 'required|string|max:16',
            'hubungan_keluarga_id' => 'required|exists:hubungankeluargas,id',
            'nama_depan' => 'required|string|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            // 'nomor_hp' => ['regex:/^(\+62|0)[8123456789][0-9]{8,12}$/'],
            // 'email' => 'email',
        ]);

        try {
            // Cari data anggota berdasarkan ID, jika tidak ditemukan akan menampilkan error 404
            $anggota = AnggotaKeluarga::findOrFail($id);

            // Pastikan bahwa dalam satu keluarga (no_kk) tidak ada lebih dari satu kepala keluarga
            if ($request->hubungan_keluarga_id == 1) {
                $existingKepalaKeluarga = AnggotaKeluarga::where('no_kk', $anggota->no_kk)
                    ->where('hubungan_keluarga_id', 1)
                    ->where('id', '!=', $id) // Mengecualikan anggota yang sedang diedit
                    ->exists();

                if ($existingKepalaKeluarga) {
                    return redirect()->back()->with('danger', '<b>GAGAL!</b> Setiap keluarga hanya boleh memiliki satu kepala keluarga.');
                }
            }

            // Update data anggota
            $anggota->hubungan_keluarga_id = $request->hubungan_keluarga_id;
            $anggota->nama_depan = $request->nama_depan;
            $anggota->nama_tengah = $request->nama_tengah;
            $anggota->nama_belakang = $request->nama_belakang;
            
            $anggota->jenis_kelamin = $request->jenis_kelamin ?? null;

            // dd($anggota->jenis_kelamin);

            $anggota->tempat_lahir = $request->tempat_lahir ?? null;
            $anggota->tanggal_lahir = $request->tanggal_lahir ?? null;
            
            $anggota->golongan_darah_id = $request->golongan_darah_id ?? null;
            $anggota->status_baptis_id = $request->status_baptis_id ?? null;
            $anggota->status_sidi_id = $request->status_sidi_id ?? null;
            $anggota->intra_id = $request->intra_id ?? null;
            $anggota->status_pernikahan_id = $request->status_pernikahan_id ?? null;
            $anggota->gelar_depan_id = $request->gelar_depan_id ?? null;
            $anggota->gelar_belakang_id = $request->gelar_belakang_id ?? null;
            $anggota->jenis_pekerjaan_id = $request->jenis_pekerjaan_id ?? null;
            $anggota->status_domisili_id = $request->status_domisili_id ?? null;
            $anggota->penyandang_cacat_id = $request->penyandang_cacat_id ?? null;
            $anggota->pendidikan_terakhir_id = $request->pendidikan_terakhir_id ?? null;
            $anggota->suku_id = $request->suku_id ?? null;
            
            // informasi kontak
            $anggota->nomor_hp = $request->nomor_hp ?? null;
            $anggota->email = $request->email ?? null;

            $anggota->save();

            // Jika berhasil, tampilkan alert sukses
            return redirect()->back()->with('success', '<b>Berhasil!</b> Data anggota keluarga berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika gagal, tampilkan alert error dengan pesan error
            return redirect()->back()->with('error', '<b>GAGAL!</b> Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }








    // keluarga/anggota/destroy
    public function anggotaDestroy($id)
    {
        // dd('anggotaDestroy');
        try {
            $anggotakeluarga = Anggotakeluarga::findOrFail($id);
            $anggotakeluarga->delete(); // Soft delete jika menggunakan SoftDeletes
            return redirect()->back()->with('success', 'Data anggota keluarga berhasil dipindahkan ke tempat sampah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data anggota keluarga gagal dihapus.');
        }
    }
        
    
    
    // keluarga/anggota/restore
    // restore | kembalikan data dari softDelete atau ke tabel utama 
    public function anggotaRestore($id)
    {
        try {
            $anggotakeluarga = Anggotakeluarga::onlyTrashed()->findOrFail($id);
            $anggotakeluarga->restore(); // Mengembalikan data dari soft delete
            return redirect()->back()->with('success', 'Data anggota keluarga berhasil dikembalikan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data anggota keluarga gagal dikembalikan.');
        }
    }


    
    
    // keluarga/anggota/forceDelete
    // forceDelete | hapus permanen dari database
    public function anggotaForceDelete($id)
    {
        try {
            $anggotakeluarga = Anggotakeluarga::withTrashed()->findOrFail($id);
            $anggotakeluarga->forceDelete(); // Hapus permanen dari database
            return redirect()->back()->with('success', 'Data anggota keluarga berhasil dihapus secara permanen.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data anggota keluarga gagal dihapus secara permanen.');
        }
    }







}
