<?php

namespace App\Http\Controllers\AdminMaster\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gelarbelakang;
use Carbon\Carbon;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Support\Facades\Validator;

class GelarBelakangController extends Controller
{

    // index
    public function index() {

        // Create a query to get Wilayah where wilayah is not null
        $query = Gelarbelakang::where('gelarbelakang', '!=', Null);

        // Check if there is a search parameter 's' in the request
        if ($s = request()->s) {
            // Filter the query to include only records where wilayah contains the search parameter
            $query->where('gelarbelakang', 'LIKE', '%' . $s . '%');
        }

        $datas = $query->orderBy('id', 'desc')->paginate(10);

        // Calculate total data
        $totalData = $query->count();

        // Check if the third segment of the request URL is 'tempat-sampah'
        $isTrashed = request()->segment(3) == 'trash';

        // page title
        $pageTitle = 'Gelar Belakang';
        $pageDescription = "Kelola daftar Gelar Belakang yang digunakan dalam formulir data anggota jemaat. Anda dapat menambah, mengubah, atau menghapus data Gelar Belakang sesuai kebutuhan.";

        if ($isTrashed) {
        $query = $query->onlyTrashed(); // Retrieve only soft-deleted records
        $datas = $query->onlyTrashed()->orderBy('id', 'desc')->paginate(10);

        // page title
        $pageTitle = 'Gelar Belakang';
        $pageDescription = "Hapus data Gelar Belakang yang tidak diperlukan lagi dalam sistem. Data yang dihapus akan masuk ke tempat sampah sebelum dihapus secara permanen.";
        }

        // Calculate total trashed data
        $totalDataTrashed = $query->onlyTrashed()->count();

        // Return the view 'wilayah.index' with the data and the current page index
        return view('AdminMaster.MasterData.GelarBelakang.index', compact('pageTitle', 'pageDescription','datas', 'totalData', 'totalDataTrashed'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // create
    public function create()
    {
        $pageTitle = "Tambah Gelar Belakang";
        $pageDescription = "Tambahkan data Gelar Belakang baru untuk digunakan dalam formulir data anggota jemaat. Pastikan informasi Gelar Belakang yang dimasukkan akurat dan lengkap.";
        return view('AdminMaster.MasterData.GelarBelakang.form', compact('pageTitle', 'pageDescription'));
    }

    // store
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'gelarbelakang' => 'required',
            ],
        );


        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = new Gelarbelakang();
                $data->gelarbelakang = $request->gelarbelakang;
                $data->keterangan = $request->keterangan;
                $data->save();

                return redirect()->route('adminmaster.masterdata.gelarbelakang')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah ditambahkan ke database'));
            } catch (\Throwable $th) {
                return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data gagal ditambahkan ke database'));
            }
        }
    }

    // show
    public function show($id)
    {
        $data = Gelarbelakang::findOrFail($id);
        
        $pageTitle = "Detail Gelar Belakang";
        $pageDescription = "Lihat informasi lengkap mengenai Gelar Belakang yang terdaftar dalam sistem. Data ini digunakan untuk mengisi formulir data anggota jemaat.";
        return view('AdminMaster.MasterData.GelarBelakang.form', compact('pageTitle','pageDescription','data'));
    }

    // edit
    public function edit($id)
    {
        $data = Gelarbelakang::findOrFail($id);
        
        $pageTitle = "Ubah Gelar Belakang";
        $pageDescription = "Perbarui informasi Gelar Belakang yang sudah ada dalam sistem. Pastikan perubahan yang dilakukan sesuai dengan data yang benar.";
        return view('AdminMaster.MasterData.GelarBelakang.form', compact('pageTitle','pageDescription','data'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'gelarbelakang' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = Gelarbelakang::find($id);
                $data->gelarbelakang = $request->gelarbelakang;
                $data->keterangan = $request->keterangan;
                $data->update();

                return redirect()->route('adminmaster.masterdata.gelarbelakang')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah diubah'));
            } catch (\Throwable $th) {
                return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data gagal diubah'));
            }
        }
    }


    // destroy
    public function destroy($id)
    {
        try {
            $data = Gelarbelakang::findOrFail($id);
            $data->delete(); // Soft delete jika menggunakan SoftDeletes
            return redirect()->back()->with('success', 'Data gelar belakang berhasil dipindahkan ke tempat sampah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data gelar belakang gagal dihapus.');
        }
    }

    // restore | kembalikan data dari softDelete atau ke tabel utama 
    public function restore($id)
    {
        try {
            $data = Gelarbelakang::onlyTrashed()->findOrFail($id);
            $data->restore(); // Mengembalikan data dari soft delete
            return redirect()->back()->with('success', 'Data gelar belakang berhasil dikembalikan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Data gelar belakang gagal dikembalikan.');
        }
    }

    // forceDelete
    public function forceDelete($id)
    {
        try {
            $data = Gelarbelakang::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return redirect()->back()->with('success', 'Terhapus permanen! Data telah dihapus secara permanen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Data gelar belakang gagal dihapus secara permanen.');
        }
    }

}
