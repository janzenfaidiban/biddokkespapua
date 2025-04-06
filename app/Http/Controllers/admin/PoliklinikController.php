<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;

// models
use App\Models\User;
use App\Models\Poliklinik;

class PoliklinikController extends Controller
{
      
    public function index()
    {
        // Ambil parameter pencarian
        $search = request()->search;

        // Cek jika segment ke-3 adalah 'trash'
        if (request()->segment(3) == 'trash') {
            // Query data yang di-soft delete
            $query = Poliklinik::onlyTrashed();
        } else {
            // Query semua data aktif
            $query = Poliklinik::query();
        }

        // Jika ada pencarian, filter berdasarkan nama_poliklinik
        if ($search) {
            $query->where('nama_poliklinik', 'LIKE', '%' . $search . '%');
        }

        // Urutkan berdasarkan nama_poliklinik ascending
        $datas = $query->orderBy('nama_poliklinik', 'asc')->get();

        // Hitung jumlah data yang di-soft delete
        $totalOnlyTrashed = Poliklinik::onlyTrashed()->count();

        // Hitung jumlah semua data termasuk yang dihapus
        $totalAll = Poliklinik::withTrashed()->count();

        // Teks untuk judul dan deskripsi halaman
        $pageTitle = 'Data Poliklinik';
        $pageDescription = 'Daftar poliklinik yang tersedia.';

        return view('admin.poliklinik.index', compact(
            'pageTitle',
            'pageDescription',
            'datas',
            'totalOnlyTrashed',
            'totalAll'
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poliklinik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nama_kepala' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:polikliniks,email',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();
        try {
            // Enkripsi password sebelum disimpan
            $data = $request->all();
            $data['password'] = bcrypt($request->password);

            Poliklinik::create($data);

            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data poliklinik berhasil ditambahkan.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Tidak bisa menyimpan data. Error: ' . $th->getMessage()));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poliklinik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nama_kepala' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:polikliniks,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        DB::beginTransaction();
        try {
            $poliklinik = Poliklinik::findOrFail($id);

            $data = $request->all();
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            } else {
                // Jangan update password jika kosong
                unset($data['password']);
            }

            $poliklinik->update($data);

            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data poliklinik berhasil diperbarui.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Tidak bisa memperbarui data. Error: ' . $th->getMessage()));
        }
    }

    public function softDelete($id)
    {
        DB::beginTransaction();
        try {
            $poliklinik = Poliklinik::findOrFail($id);
            $poliklinik->delete();
            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Data berhasil dipindahkan ke tempat sampah.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Tidak bisa menghapus data. Error: ' . $th->getMessage()));
        }
    }
    
    public function restore($id)
    {
        DB::beginTransaction();
        try {
            $poliklinik = Poliklinik::onlyTrashed()->findOrFail($id);
            $poliklinik->restore();
            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Data berhasil dikembalikan.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal mengembalikan data. Error: ' . $th->getMessage()));
        }
    }
    
    public function forceDelete($id)
    {
        DB::beginTransaction();
        try {
            $poliklinik = Poliklinik::onlyTrashed()->findOrFail($id);
            $poliklinik->forceDelete();
            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Data berhasil dihapus permanen.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal menghapus permanen. Error: ' . $th->getMessage()));
        }
    }
    

    



}
