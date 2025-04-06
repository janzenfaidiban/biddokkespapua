<?php

namespace App\Http\Controllers\AdminSinode\Jemaat;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Anggotakeluarga;
use App\Models\Hubungankeluarga;
use App\Models\Golongandarah;
use App\Models\Statusbaptis;
use App\Models\Statussidi;
use App\Models\Intra;
use App\Models\Statuspernikahan;
use App\Models\Gelardepan;
use App\Models\Gelarbelakang;
use App\Models\Jemaat;
use App\Models\Jenispekerjaan;
use App\Models\Statusdomisili;
use App\Models\Penyandangcacat;
use App\Models\Pendidikanterakhir;
use App\Models\Suku;
use App\Models\Kartukeluarga;
use App\Models\Klasis;

class AnggotaKeluargaController extends Controller
{
    public function index()
    {
        $datas = Anggotakeluarga::where([
            ['no_kk', '!=', Null],
            [function ($query) {
                if (($s = request()->s)) {
                    $query->orWhere('no_kk', 'LIKE', '%' . $s . '%')
                    ->orWhere('nama_depan', 'LIKE', '%' . $s . '%')
                    ->orWhere('nama_tengah', 'LIKE', '%' . $s . '%')
                    ->orWhere('nama_belakang', 'LIKE', '%' . $s . '%')
                    ->get();
                }
            }]
        ])->get();
        return view('AdminSinode.anggotakeluarga.index', compact('datas'));
    }

    // create
    public function create(Request $request)
    {

        $kepalakel = NULL;
        $ket = '';
        $getKk = Kartukeluarga::where('no_kk', $request->no_kk)->with('detailjemaat')->first();
        if($request->no_kk == null)
        {
            $ket = 'Silahkan isi nomor Kartu Keluarga untuk menambahkan anggota keluarga.';
            // return redirect()->route('sinode.anggotakeluarga.create')->with(BootstrapAlerts::addError('Data kartu keluarga tidak ditemukan !'));
        } elseif($request->no_kk !== null){
            $ket = 'Kartu keluarga tidak ditemukan. Pastikan lagi bahwa Nomor Kartu Keluarga sudah ditambahkan.';
        }

        if($getKk)
        {
            $anggotakeluarga = Anggotakeluarga::with('hubungankeluarga')->get();
            foreach ($anggotakeluarga as $item_anggotakeluarga):
            if ($item_anggotakeluarga->no_kk == $getKk->no_kk):
                    if ($item_anggotakeluarga->hubungankeluarga->id == 1) :
                        $kepalakel =  $item_anggotakeluarga->nama_depan.' '.$item_anggotakeluarga->nama_belakang;
                    endif;
                endif;
            endforeach;
        }

        // Klasis
        $klasis = Klasis::all();

        // Jemaat
        $jemaat = Jemaat::all();

        // data master
        $no_kks = Kartukeluarga::all();
        $hubungankeluargas = Hubungankeluarga::all();
        $golongandarahs = Golongandarah::all();
        $statusbaptiss = Statusbaptis::all();
        $statussidis = Statussidi::all();
        $intras = Intra::all();
        $statuspernikahans = Statuspernikahan::all();
        $gelardepans = Gelardepan::all();
        $gelarbelakangs = Gelarbelakang::all();
        $jenispekerjaans = Jenispekerjaan::all();
        $statusdomisilis = Statusdomisili::all();
        $penyandangcacats = Penyandangcacat::all();
        $pendidikanterakhirs = Pendidikanterakhir::all();
        $sukus = Suku::all();

        return view('AdminSinode.anggotakeluarga.create', compact('no_kks','hubungankeluargas','golongandarahs','statusbaptiss','statussidis','intras','statuspernikahans','gelardepans','gelarbelakangs','jenispekerjaans','statusdomisilis','penyandangcacats','pendidikanterakhirs','sukus','jemaat','klasis','getKk','kepalakel','ket'));
    }

    // store
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'no_kk' => 'required',
                'nama_depan' => 'required',
            ],
            [
                'no_kk.required' => 'Data ini wajib dilengkapi',
                'nama_depan.required' => 'Data ini wajib dilengkapi',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {

                // Data User
                $anggota = New Anggotakeluarga();
                $anggota->no_kk = $request->no_kk;
                $anggota->nama_depan = $request->nama_depan;
                $anggota->nama_tengah = $request->nama_tengah;
                $anggota->nama_belakang = $request->nama_belakang;
                $anggota->hubungan_keluarga_id = $request->hubungan_keluarga_id;
                $anggota->status_baptis_id = $request->status_baptis_id;
                $anggota->status_sidi_id = $request->status_sidi_id;
                $anggota->intra_id = $request->intra_id;
                $anggota->status_pernikahan_id = $request->status_pernikahan_id;
                $anggota->gelar_depan_id = $request->gelar_depan_id;
                $anggota->gelar_belakang_id = $request->gelar_belakang_id;
                $anggota->jenis_pekerjaan_id = $request->jenis_pekerjaan_id;
                $anggota->status_domisili_id = $request->status_domisili_id;
                $anggota->penyandang_cacat_id = $request->penyandang_cacat_id;
                $anggota->pendidikan_terakhir_id = $request->pendidikan_terakhir_id;
                $anggota->suku_id = $request->suku_id;
                $anggota->keterangan = $request->keterangan;
                $anggota->save();
                return redirect()->route('sinode.AnggotaKeluarga')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah ditambahkan'));
            } catch (\Throwable $th) {
                return redirect()->route('sinode.AnggotaKeluarga')->with(BootstrapAlerts::addError('Gagal! Data gagal ditambahkan'));
            }
        }
    }

    // show
    public function show($id, Request $request)
    {
        $kepalakel = NULL;
        $data = Anggotakeluarga::where('id', $id)->first();
        $getKk = Kartukeluarga::where('no_kk', $data->no_kk)->with('detailjemaat')->first();
        if($request->no_kk == null)
        {
            $ket = 'Silahkan isi nomor Kartu Keluarga untuk menambahkan anggota keluarga.';
            // return redirect()->route('sinode.anggotakeluarga.create')->with(BootstrapAlerts::addError('Data kartu keluarga tidak ditemukan !'));
        } elseif($request->no_kk !== null){
            $ket = 'Kartu keluarga tidak ditemukan. Pastikan lagi bahwa Nomor Kartu Keluarga sudah ditambahkan.';
        }

        if($getKk)
        {
            $anggotakeluarga = Anggotakeluarga::with('hubungankeluarga')->get();
            foreach ($anggotakeluarga as $item_anggotakeluarga):
            if ($item_anggotakeluarga->no_kk == $getKk->no_kk):
                    if ($item_anggotakeluarga->hubungankeluarga->id == 1) :
                        $kepalakel =  $item_anggotakeluarga->nama_depan.' '.$item_anggotakeluarga->nama_belakang;
                    endif;
                endif;
            endforeach;
        }

        // Klasis
        $klasis = Klasis::all();

        // Jemaat
        $jemaat = Jemaat::all();

        // data master
        $no_kks = Kartukeluarga::all();
        $hubungankeluargas = Hubungankeluarga::all();
        $golongandarahs = Golongandarah::all();
        $statusbaptiss = Statusbaptis::all();
        $statussidis = Statussidi::all();
        $intras = Intra::all();
        $statuspernikahans = Statuspernikahan::all();
        $gelardepans = Gelardepan::all();
        $gelarbelakangs = Gelarbelakang::all();
        $jenispekerjaans = Jenispekerjaan::all();
        $statusdomisilis = Statusdomisili::all();
        $penyandangcacats = Penyandangcacat::all();
        $pendidikanterakhirs = Pendidikanterakhir::all();
        $sukus = Suku::all();

        return view('AdminSinode.anggotakeluarga.edit',
        compact('no_kks','hubungankeluargas','golongandarahs','statusbaptiss','statussidis','intras','statuspernikahans','gelardepans','gelarbelakangs','jenispekerjaans','statusdomisilis','penyandangcacats','pendidikanterakhirs','sukus','jemaat','klasis','getKk','kepalakel','ket','data')
        );
    }

    // edit
    public function edit($id, Request $request)
    {
        $kepalakel = NULL;
        $data = Anggotakeluarga::where('id', $id)->first();
        $getKk = Kartukeluarga::where('no_kk', $data->no_kk)->with('detailjemaat')->first();
        if($request->no_kk == null)
        {
            $ket = 'Silahkan isi nomor Kartu Keluarga untuk menambahkan anggota keluarga.';
            // return redirect()->route('sinode.anggotakeluarga.create')->with(BootstrapAlerts::addError('Data kartu keluarga tidak ditemukan !'));
        } elseif($request->no_kk !== null){
            $ket = 'Kartu keluarga tidak ditemukan. Pastikan lagi bahwa Nomor Kartu Keluarga sudah ditambahkan.';
        }

        if($getKk)
        {
            $anggotakeluarga = Anggotakeluarga::with('hubungankeluarga')->get();
            foreach ($anggotakeluarga as $item_anggotakeluarga):
            if ($item_anggotakeluarga->no_kk == $getKk->no_kk):
                    if ($item_anggotakeluarga->hubungankeluarga->id == 1) :
                        $kepalakel =  $item_anggotakeluarga->nama_depan.' '.$item_anggotakeluarga->nama_belakang;
                    endif;
                endif;
            endforeach;
        }

        // Klasis
        $klasis = Klasis::all();

        // Jemaat
        $jemaat = Jemaat::all();

        // data master
        $no_kks = Kartukeluarga::all();
        $hubungankeluargas = Hubungankeluarga::all();
        $golongandarahs = Golongandarah::all();
        $statusbaptiss = Statusbaptis::all();
        $statussidis = Statussidi::all();
        $intras = Intra::all();
        $statuspernikahans = Statuspernikahan::all();
        $gelardepans = Gelardepan::all();
        $gelarbelakangs = Gelarbelakang::all();
        $jenispekerjaans = Jenispekerjaan::all();
        $statusdomisilis = Statusdomisili::all();
        $penyandangcacats = Penyandangcacat::all();
        $pendidikanterakhirs = Pendidikanterakhir::all();
        $sukus = Suku::all();

        return view('AdminSinode.anggotakeluarga.edit',
        compact('no_kks','hubungankeluargas','golongandarahs','statusbaptiss','statussidis','intras','statuspernikahans','gelardepans','gelarbelakangs','jenispekerjaans','statusdomisilis','penyandangcacats','pendidikanterakhirs','sukus','jemaat','klasis','getKk','kepalakel','ket','data')
        );
    }

    // update
    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nama_depan' => 'required',
            ],
            [
                'nama_depan.required' => 'Nama Depan wajib dilengkapi',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = Anggotakeluarga::find($id);


                $data->nama_depan = $request->nama_depan;
                $data->nama_tengah = $request->nama_tengah;
                $data->nama_belakang = $request->nama_belakang;

                $data->hubungan_keluarga_id = $request->hubungan_keluarga_id;
                $data->golongan_darah_id = $request->golongan_darah_id;
                $data->status_baptis_id = $request->status_baptis_id;
                $data->status_sidi_id = $request->status_sidi_id;
                $data->intra_id = $request->intra_id;
                $data->status_pernikahan_id = $request->status_pernikahan_id;
                $data->gelar_depan_id = $request->gelar_depan_id;
                $data->gelar_belakang_id = $request->gelar_belakang_id;
                $data->jenis_pekerjaan_id = $request->jenis_pekerjaan_id;
                $data->status_domisili_id = $request->status_domisili_id;
                $data->penyandang_cacat_id = $request->penyandang_cacat_id;
                $data->pendidikan_terakhir_id = $request->pendidikan_terakhir_id;
                $data->suku_id = $request->suku_id;

                $data->keterangan = $request->keterangan;

                $data->update();

                return redirect()->route('sinode.AnggotaKeluarga.show',$id)->with(BootstrapAlerts::addSuccess('Berhasil! Data telah diubah'));
            } catch (\Throwable $th) {
                return redirect()->route('sinode.AnggotaKeluarga')->with(BootstrapAlerts::addError('Gagal! Data gagal diubah'));
            }
        }
    }

    // destroy
    public function destroy($id)
    {
        $data = Anggotakeluarga::where('id', $id)->first();
        return view('AdminSinode.anggotakeluarga.destroy',compact('data'));

    }

    // trash
    public function trash($id)
    {
        //
        return 'jemaat > trash';
    }

    // restore
    public function restore($id)
    {
        $data = Anggotakeluarga::onlyTrashed()->where('id', $id);
        $data->restore();
        return redirect()->route('sinode.AnggotaKeluarga')->with(BootstrapAlerts::addError('Berhasil dikembalikan! Data telah dikembalikan dengan berhasil'));
    }

    // delete
    public function delete($id)
    {
        $data = Anggotakeluarga::find($id);
        $data->delete();
        return redirect()->route('sinode.AnggotaKeluarga')->with(BootstrapAlerts::addError('Terhapus sementara! Data telah dihapus sementara'));
    }

    // forceDelete
    public function ForceDelete($id)
    {
        $data = Anggotakeluarga::find($id);
        $data->forceDelete();
        return redirect()->route('sinode.AnggotaKeluarga')->with(BootstrapAlerts::addError('Terhapus permanen! Data telah dihapus secara permanen'));
    }

}
