<?php

namespace App\Http\Controllers\AdminMaster;

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
        // menampilkan total data klasis
        $totalKlasis = Klasis::count();
        // menampilkan total data jemaat
        $totalJemaat = Jemaat::count();
        // menampilkan total data keluarga
        $totalKeluarga = Kartukeluarga::count();
        // menampilkan total data anggota keluarga
        $totalAnggotaKeluarga = Anggotakeluarga::count();

        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Beranda';
        $pageDescription = 'Halaman beranda admin master. Menampilkan rekapan data klasis, jemaat, keluarga, dan anggota keluarga.';

        return view('AdminMaster.beranda.index', compact(
                    'pageTitle', 
                    'pageDescription', 
                    'totalKlasis', 
                    'totalJemaat', 
                    'totalKeluarga', 
                    'totalAnggotaKeluarga',
        ));
    }

}
