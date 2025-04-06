<?php

namespace App\Http\Controllers\AdminJemaat;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// data jemaat & pengguna
use App\Models\Jemaat;
use App\Models\User;

// data keluarga & anggota keluarga
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
      
    // index
    public function index()
    {
        // Get the role of the authenticated user
        $role = Auth::user()->roles->pluck('name')->implode(', ');

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

        // total data statusSidi
        $totalStatusSidi = Statussidi::select('statussidi')
            ->selectRaw('COUNT(anggotakeluargas.status_sidi_id) as count')
            ->join('anggotakeluargas', 'statussidis.id', '=', 'anggotakeluargas.status_sidi_id')
            ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
            ->groupBy('statussidi')
            ->get();

        // total data statusBaptis
        $totalStatusBaptis = Statusbaptis::select('statusbaptis')
            ->selectRaw('COUNT(anggotakeluargas.status_baptis_id) as count')
            ->join('anggotakeluargas', 'statusbaptis.id', '=', 'anggotakeluargas.status_baptis_id')
            ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
            ->groupBy('statusbaptis')
            ->get();

        // total data statusPernikahan
        $totalStatusPernikahan = Statuspernikahan::select('statuspernikahan')
            ->selectRaw('COUNT(anggotakeluargas.status_pernikahan_id) as count')
            ->join('anggotakeluargas', 'statuspernikahans.id', '=', 'anggotakeluargas.status_pernikahan_id')
            ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
            ->groupBy('statuspernikahan')
            ->get();

        // total data intra
        $totalIntra = Intra::select('intra')
            ->selectRaw('COUNT(anggotakeluargas.intra_id) as count')
            ->join('anggotakeluargas', 'intras.id', '=', 'anggotakeluargas.intra_id')
            ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
            ->groupBy('intra')
            ->get();

        // total data suku
        $totalSuku = Suku::select('suku')
        ->selectRaw('COUNT(anggotakeluargas.suku_id) as count')
        ->join('anggotakeluargas', 'sukus.id', '=', 'anggotakeluargas.suku_id')
        ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
        ->groupBy('suku')
        ->get();

        // total data statusDomisili
        $totalStatusDomisili = Statusdomisili::select('statusdomisili')
        ->selectRaw('COUNT(anggotakeluargas.status_domisili_id) as count')
        ->join('anggotakeluargas', 'statusdomisilis.id', '=', 'anggotakeluargas.status_domisili_id')
        ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
        ->groupBy('statusdomisili')
        ->get();

        // total data golongan darah
        $totalGolonganDarah = Golongandarah::select('golongandarah')
        ->selectRaw('COUNT(anggotakeluargas.golongan_darah_id) as count')
        ->join('anggotakeluargas', 'golongandarahs.id', '=', 'anggotakeluargas.golongan_darah_id')
        ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
        ->groupBy('golongandarah')
        ->get();

        // total data gelar depan
        $totalGelarDepan = Gelardepan::select('gelardepan')
        ->selectRaw('COUNT(anggotakeluargas.gelar_depan_id) as count')
        ->join('anggotakeluargas', 'gelardepans.id', '=', 'anggotakeluargas.gelar_depan_id')
        ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
        ->groupBy('gelardepan')
        ->get();

        // total data gelar belakang
        $totalGelarBelakang = Gelarbelakang::select('gelarbelakang')
        ->selectRaw('COUNT(anggotakeluargas.gelar_belakang_id) as count')
        ->join('anggotakeluargas', 'gelarbelakangs.id', '=', 'anggotakeluargas.gelar_belakang_id')
        ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
        ->groupBy('gelarbelakang')
        ->get();

        // total data penyandang cacat
        $totalPenyandangCacat = Penyandangcacat::select('penyandangcacat')
        ->selectRaw('COUNT(anggotakeluargas.penyandang_cacat_id) as count')
        ->join('anggotakeluargas', 'penyandangcacats.id', '=', 'anggotakeluargas.penyandang_cacat_id')
        ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
        ->groupBy('penyandangcacat')
        ->get();

        // Total data pendidikan terakhir
        $totalPendidikanTerakhir = PendidikanTerakhir::select('pendidikanterakhir')
        ->selectRaw('COUNT(anggotakeluargas.pendidikan_terakhir_id) as count')
        ->join('anggotakeluargas', 'pendidikanterakhirs.id', '=', 'anggotakeluargas.pendidikan_terakhir_id')
        ->whereIn('anggotakeluargas.no_kk', $keluargaIds)
        ->groupBy('pendidikanterakhir')
        ->get();








        // Fetch members with birthdays this month
        $currentMonth = date('m');
        $birthdayMembers = Anggotakeluarga::whereNotNull('tanggal_lahir')
            ->whereRaw("MONTH(tanggal_lahir) = ?", [$currentMonth])
            ->get();
        
        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Beranda';
        $pageDescription = 'Halaman beranda admin jemaat. Menampilkan rekapan data keluarga dan anggota keluarga.';
    

        return view('beranda.index', compact(
            'pageTitle',
            'pageDescription',
            'totalKeluarga', 'totalAnggotaKeluarga', 'birthdayMembers',
            'anggotaKeluargaLakiLaki', 'anggotaKeluargaPerempuan', 
            'totalStatusSidi',
            'totalStatusBaptis',
            'totalStatusPernikahan',
            'totalIntra',
            'totalSuku',
            'totalStatusDomisili',
            'totalGolonganDarah',
            'totalGelarDepan',
            'totalGelarBelakang',
            'totalPenyandangCacat',
            'totalPendidikanTerakhir',

            'totalKeluarga','totalAnggotaKeluarga','anggotaKeluargaLakiLaki','anggotaKeluargaPerempuan',
            
        ));
    }



}
