<?php

namespace App\Http\Controllers\AdminSinode\Jemaat;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Kartukeluarga;
use App\Models\Anggotakeluarga;
use App\Models\Hubungankeluarga;
use Carbon\Carbon;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        $datas = Kartukeluarga::where([
            ['no_kk', '!=', Null],
            [function ($query) {
                if (($s = request()->s)) {
                    $query->orWhere('no_kk', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->get();
        $anggotakeluarga = Anggotakeluarga::with('hubungankeluarga')->get();
        $hubungankeluarga = Hubungankeluarga::where('id', 1)->get();
        return view('AdminSinode.kartukeluarga.index', compact('datas', 'hubungankeluarga', 'anggotakeluarga'));
    }

    // create
    public function create()
    {
        $jemaats = Jemaat::all();
        return view('AdminSinode.kartukeluarga.create', compact('jemaats'));
    }

    // store
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jemaat_id' => 'required',
                'no_kk' => 'required|numeric|unique:kartukeluargas,no_kk',
            ],
            [
                'jemaat_id.required' => 'Data ini wajib dilengkapi',
                'no_kk.required' => 'Data ini wajib dilengkapi',
                'no_kk.numeric' => 'Data ini harus angka',
                'no_kk.unique' => 'Data ini sudah ada',
            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = new Kartukeluarga();
                $data->jemaat_id = $request->jemaat_id;
                $data->no_kk = $request->no_kk;
                $data->alamat = $request->alamat;
                $data->keterangan = $request->keterangan;
                $data->save();

                return redirect()->route('sinode.KartuKeluarga')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah ditambahkan ke database'));
            } catch (\Throwable $th) {
                return redirect()->route('sinode.KartuKeluarga')->with(BootstrapAlerts::addError('Gagal! Data gagal ditambahkan ke database'));
            }
        }
    }

    // show
    public function show($id)
    {
        $jemaats = Jemaat::all();
        $data = Kartukeluarga::where('id',$id)->first();
        return view('AdminSinode.kartukeluarga.edit',compact('jemaats','data'));
    }

    // edit
    public function edit($id)
    {
        $jemaats = Jemaat::all();
        $data = Kartukeluarga::where('id',$id)->first();
        return view('AdminSinode.kartukeluarga.edit',compact('jemaats','data'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jemaat_id' => 'required',
            ],
            [
                'jemaat_id.required' => 'Data ini wajib dilengkapi',

            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = Kartukeluarga::find($id);
                $data->jemaat_id = $request->jemaat_id;
                // $data->no_kk = $request->no_kk;
                $data->alamat = $request->alamat;
                $data->keterangan = $request->keterangan;
                $data->update();

                return redirect()->route('sinode.KartuKeluarga')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah diubah ke database'));
            } catch (\Throwable $th) {
                return redirect()->route('sinode.KartuKeluarga')->with(BootstrapAlerts::addError('Gagal! Data gagal diubah ke database'));
            }
        }
    }

    // destroy
    public function destroy($id)
    {
        $data = Kartukeluarga::where('id',$id)->first();
        return view('AdminSinode.kartukeluarga.destroy',compact('data'));
    }

    // trash
    public function trash($id)
    {
        //
        return 'jemaat > kartu keluarga >  trash';
    }

    // restore
    public function restore($id)
    {
        //
        return 'jemaat > kartu keluarga >  restore';
    }

    // delete
    public function delete($id)
    {
        $data = Kartukeluarga::find($id);
        $data->delete();
        return redirect()->route('sinode.KartuKeluarga')->with(BootstrapAlerts::addError('Terhapus sementara! Data telah dihapus sementara'));
    }

}
