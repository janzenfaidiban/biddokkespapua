<?php

namespace App\Http\Controllers\AdminMaster\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Jenispekerjaan;
use Carbon\Carbon;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisPekerjaanController extends Controller
{

    // index
    public function index() {

        // Create a query to get Wilayah where wilayah is not null
        $query = Jenispekerjaan::where('jenispekerjaan', '!=', Null);

        // Check if there is a search parameter 's' in the request
        if ($s = request()->s) {
            // Filter the query to include only records where wilayah contains the search parameter
            $query->where('jenispekerjaan', 'LIKE', '%' . $s . '%');
        }

        $datas = $query->orderBy('id', 'desc')->paginate(10);

        // Calculate total data
        $totalData = $query->count();

        // Check if the third segment of the request URL is 'tempat-sampah'
        $isTrashed = request()->segment(3) == 'trash';

        // page title
        $pageTitle = 'Jenis Pekerjaan';
        $pageDescription = "Kelola daftar Jenis Pekerjaan yang digunakan dalam formulir data anggota jemaat. Anda dapat menambah, mengubah, atau menghapus data Jenis Pekerjaan sesuai kebutuhan.";

        if ($isTrashed) {
        $query = $query->onlyTrashed(); // Retrieve only soft-deleted records
        $datas = $query->onlyTrashed()->orderBy('id', 'desc')->paginate(10);

        // page title
        $pageTitle = 'Jenis Pekerjaan';
        $pageDescription = "Hapus data Jenis Pekerjaan yang tidak diperlukan lagi dalam sistem. Data yang dihapus akan masuk ke tempat sampah sebelum dihapus secara permanen.";
        }

        // Calculate total trashed data
        $totalDataTrashed = $query->onlyTrashed()->count();

        // Return the view 'wilayah.index' with the data and the current page index
        return view('AdminMaster.MasterData.JenisPekerjaan.index', compact('pageTitle', 'pageDescription','datas', 'totalData', 'totalDataTrashed'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // create
    public function create()
    {
        $pageTitle = "Tambah Jenis Pekerjaan";
        $pageDescription = "Tambahkan data Jenis Pekerjaan baru untuk digunakan dalam formulir data anggota jemaat. Pastikan informasi Jenis Pekerjaan yang dimasukkan akurat dan lengkap.";
        return view('AdminMaster.MasterData.JenisPekerjaan.form', compact('pageTitle', 'pageDescription'));
    }

    // store
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jenispekerjaan' => 'required',
            ],
        );


        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = new Jenispekerjaan();
                $data->jenispekerjaan = $request->jenispekerjaan;
                $data->keterangan = $request->keterangan;
                $data->save();

                return redirect()->route('adminmaster.masterdata.jenispekerjaan')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah ditambahkan ke database'));
            } catch (\Throwable $th) {
                return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data gagal ditambahkan ke database'));
            }
        }
    }

    // show
    public function show($id)
    {
        $data = Jenispekerjaan::findOrFail($id);
        
        $pageTitle = "Detail Jenis Pekerjaan";
        $pageDescription = "Lihat informasi lengkap mengenai Jenis Pekerjaan yang terdaftar dalam sistem. Data ini digunakan untuk mengisi formulir data anggota jemaat.";
        return view('AdminMaster.MasterData.JenisPekerjaan.form', compact('pageTitle','pageDescription','data'));
    }

    // edit
    public function edit($id)
    {
        $data = Jenispekerjaan::findOrFail($id);
        
        $pageTitle = "Ubah Jenis Pekerjaan";
        $pageDescription = "Perbarui informasi Jenis Pekerjaan yang sudah ada dalam sistem. Pastikan perubahan yang dilakukan sesuai dengan data yang benar.";
        return view('AdminMaster.MasterData.Jenispekerjaan.form', compact('pageTitle','pageDescription','data'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'jenispekerjaan' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = Jenispekerjaan::find($id);
                $data->jenispekerjaan = $request->jenispekerjaan;
                $data->keterangan = $request->keterangan;
                $data->update();

                return redirect()->route('adminmaster.masterdata.jenispekerjaan')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah diubah'));
            } catch (\Throwable $th) {
                return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Data gagal diubah'));
            }
        }
    }


    // destroy
    public function destroy($id)
    {
        try {
            $data = Jenispekerjaan::findOrFail($id);
            $data->delete(); // Soft delete jika menggunakan SoftDeletes
            return redirect()->back()->with('success', 'Data jenis pekerjaan berhasil dipindahkan ke tempat sampah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Gagal! Data jenis pekerjaan gagal dihapus.');
        }
    }

    // restore | kembalikan data dari softDelete atau ke tabel utama 
    public function restore($id)
    {
        try {
            $data = Jenispekerjaan::onlyTrashed()->findOrFail($id);
            $data->restore(); // Mengembalikan data dari soft delete
            return redirect()->back()->with('success', 'Data jenis pekerjaan berhasil dikembalikan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Data jenis pekerjaan gagal dikembalikan.');
        }
    }

    // forceDelete
    public function forceDelete($id)
    {
        try {
            $data = Jenispekerjaan::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return redirect()->back()->with('success', 'Terhapus permanen! Data telah dihapus secara permanen');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', '<b>GAGAL!</b> Data jenis pekerjaan gagal dihapus secara permanen.');
        }
    }

}
