<?php

namespace App\Http\Controllers\AdminKlasis;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Klasis;
use App\Models\Jemaat;

use App\Models\Kartukeluarga;
use App\Models\Anggotakeluarga;

// data master models
use App\Models\Statussidi;
use App\Models\Statusbaptis;
use App\Models\Statuspernikahan;
use App\Models\Intra;
use App\Models\Suku;
use App\Models\Statusdomisili;
use App\Models\Pendidikanterakhir;
use App\Models\Golongandarah;
use App\Models\Gelardepan;
use App\Models\Gelarbelakang;
use App\Models\Penyandangcacat;


class BerandaController extends Controller
{
    
    public function index()
    {
        // mengambil data user yang sedang login
        $user = Auth::user();
        // menampilkan user id yang sedang login
        $userId = $user->id;

        // klasis memiliki relasi dengan user, setiap klasis memiliki user_id
        // menampilkan data klasis berdasarkan user id yang sedang login
        $klasis = Klasis::where('user_id', $userId)->first();


        // menampilkan total data klasis berdasarkan user id yang sedang login
        $totalKlasis = Klasis::where('user_id', $userId)->count();

        // jemaat memiliki relasi dengan klasis, setiap jemaat memiliki klasis_id
        // menampilkan data jemaat berdasarkan klasis id yang sedang login
        $jemaat = Jemaat::where('klasis_id', $klasis->id)->get();

        
        // menampilkan total jemaat berdasarkan klasis id yang sedang login
        $totalJemaat = Jemaat::where('klasis_id', $klasis->id)->count();
        
        // menampilkan data keluarga berdasarkan jemaat id yang sedang login
        $keluarga = Kartukeluarga::where('jemaat_id', $jemaat->first()->id)->get();

        // menampilkan total keluarga berdasarkan jemaat id yang sedang login
        $totalKeluarga = Kartukeluarga::where('jemaat_id', $jemaat->first()->id)->count();
        
        // menampilkan data anggota keluarga berdasarkan no_kk yang diambil dari data keluarga
        $anggotaKeluarga = Anggotakeluarga::whereIn('no_kk', $keluarga->pluck('no_kk'))->get();
        
        // menampilkan total anggota keluarga berdasarkan no kakak yang diambil dari data keluarga
        $totalAnggotaKeluarga = Anggotakeluarga::whereIn('no_kk', $keluarga->pluck('no_kk'))->count();
        
        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Beranda';
        $pageDescription = 'Halaman beranda admin klasis. Menampilkan rekapan data klasis, jemaat, keluarga, dan anggota keluarga.';

        return view('AdminKlasis.beranda.index', compact(
                    'pageTitle', 
                    'pageDescription', 
                    'totalKlasis', 
                    'totalJemaat', 
                    'totalKeluarga', 
                    'totalAnggotaKeluarga',
        ));
    }

}
