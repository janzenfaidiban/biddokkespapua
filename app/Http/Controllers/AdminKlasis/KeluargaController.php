<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jemaat;
use App\Models\Kartukeluarga;
use App\Models\Anggotakeluarga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KeluargaController extends Controller
{
  
  public function index()
{
    // Create a query to get Kartukeluarga with related Jemaat, Klasis, Wilayah, and Anggotakeluarga where no_kk is not null
    $query = Kartukeluarga::with(['jemaat.klasis.wilayah', 'anggotakeluarga' => function ($query) {
        $query->where('hubungan_keluarga_id', 1);
    }])->where('no_kk', '!=', Null);

    // Check if there is a search parameter 's' in the request
    if ($s = request()->s) {
        $query->where('no_kk', 'LIKE', '%' . $s . '%');
    }

    // Check if the third segment of the request URL is 'tempat-sampah'
    $isTrashed = request()->segment(3) == 'tempat-sampah';

    if ($isTrashed) {
        $query = $query->onlyTrashed(); // Retrieve only soft-deleted records
    }

    // Get the role of the authenticated user
    $role = Auth::user()->roles->pluck('name')->implode(', ');

    if ($role == 'adminmaster') {
        $datas = $query->orderBy('id', 'desc')->paginate(10);
    } elseif ($role == 'adminklasis') {
        $datas = $query->whereHas('jemaat.klasis', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->orderBy('id', 'desc')->paginate(10);
    } elseif ($role == 'adminjemaat') {
        $datas = $query->whereHas('jemaat', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->orderBy('id', 'desc')->paginate(10);

    } else {
        $datas = collect();
    }

    $loggedUser = Jemaat::where('user_id', auth()->user()->id)->first();
    // $totalDataKeluarga = $query->where('jemaat_id', $loggedUser->id)->count();
    $totalDataAnggotaKeluarga = Anggotakeluarga::whereHas('keluarga', function ($query) use ($loggedUser) {
        $query->where('jemaat_id', $loggedUser->id);
    })->count();

    // Calculate total data
    $totalData = $query->count();

    // Calculate total trashed data
    $totalDataTrashed = $query->onlyTrashed()->count();

    return view('keluarga.index', compact('datas', 'totalData', 'totalDataTrashed', 'loggedUser', 'totalDataAnggotaKeluarga'))->with('i', (request()->input('page', 1) - 1) * 10);
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

    // $anggotaKeluarga = Anggotakeluarga::whereDoesntHave('hubungankeluarga', function($query) {
    //   $query->where('hubungan_keluarga_id', 1); // Mengecualikan Kepala Keluarga
    // })
    // ->whereHas('keluarga.jemaat', function($query) {
    //     $query->where('user_id', auth()->user()->id);
    // })
    // ->orderBy('id', 'desc')
    // ->get();

    return view('keluarga.form', compact('jemaat', 'newNoKk'));

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

              // Update data di tabel Anggotakeluarga berdasarkan anggota_keluarga_id
              $anggotaKeluarga = Anggotakeluarga::find($request->anggota_keluarga_id);
              if ($anggotaKeluarga) {
                  $anggotaKeluarga->no_kk = $request->no_kk;
                  $anggotaKeluarga->hubungan_keluarga_id = 1; // 1 = Kepala Keluarga
                  $anggotaKeluarga->save();
              }

              
              // dd($kartukeluarga);
              return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil disimpan.');
          } catch (\Throwable $th) {
              return redirect()->route('keluarga.index')->with('error', 'Gagal! Data keluarga gagal disimpan.');
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

    return view('keluarga.form', compact('item', 'jemaat'));
  }

  // show & anggota keluarga
  // menampilkan data anggota keluarga berdasarkan no_kk
  public function anggota($no_kk)
  {

    $query = Anggotakeluarga::with(['keluarga.jemaat.klasis','hubungankeluarga'])
      ->where('no_kk', $no_kk)
      ->where('nama_depan', '!=', Null
    );
    $datas = $query->orderBy('id', 'asc')->get();

    $no_kk = $no_kk;
    $query->where('no_kk', $no_kk);

    $keluarga = Kartukeluarga::where('no_kk', $no_kk)
    ->with('jemaat.klasis')
    ->first();

    
    return view('keluarga.anggota', compact('datas', 'no_kk', 'keluarga'))->with('i', (request()->input('page', 1) - 1) * 10);
  }

  // edit
  public function edit($id)
  {

    // Mengambil data jemaat beserta data klasis yang terkait berdasarkan id jemaat
    $jemaat = Jemaat::with('klasis')->where('id', $_GET['jemaat_id'])->first();

    $query = Kartukeluarga::with(['jemaat.klasis'])->where('id', $id);

    $item = $query->orderBy('id', 'asc')->first();

    return view('keluarga.form', compact('item', 'jemaat'));
  }

  // update
  public function update(Request $request, $id)
  {
  }

  // destroy
  public function destroy($id)
  {
  }

  // restore
  public function restore($id)
  {
  }

  // delete
  public function delete($id)
  {
  }

  // forceDelete
  public function ForceDelete($id)
  {
  }
}
