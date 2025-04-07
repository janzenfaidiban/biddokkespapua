<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;

// models
use App\Models\User;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        // Ambil parameter pencarian
        $search = request()->search;

        // Cek jika segment ke-3 adalah 'trash'
        if (request()->segment(3) == 'trash') {
            // Query data yang di-soft delete
            $query = Barang::onlyTrashed();
        } else {
            // Query semua data aktif
            $query = Barang::query();
        }

        // Jika ada pencarian, filter berdasarkan nama_barang
        if ($search) {
            $query->where('nama_barang', 'LIKE', '%' . $search . '%');
        }

        // Urutkan berdasarkan nama_barang ascending
        $datas = $query->orderBy('nama_barang', 'asc')->paginate(10);

        // Hitung jumlah data yang di-soft delete
        $totalOnlyTrashed = Barang::onlyTrashed()->count();

        // Hitung jumlah semua data termasuk yang dihapus
        $totalAll = Barang::withTrashed()->count();

        // Teks untuk judul dan deskripsi halaman
        $pageTitle = 'Data Barang';
        $pageDescription = 'Data master semua barang yang terdata pada sistem. Admin dapat mengelola data-data barang ini. Setiap item barang memiliki nama barang, kategori (obat atau barang habis pakai), harga satuan, dan keterangan. Hak kelola admin: tambah, lihat detail, ubah data, pindahkan data ke tempat sampah, mengembalikan data dari tempat sampah, pencarian data dan menghapus data secara permanen.';

        return view('admin.barang.index', compact(
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
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:obat,bhp',
            'harga_satuan' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            Barang::create($request->all());
            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data barang berhasil ditambahkan.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Tidak bisa menyimpan data. Error: ' . $th->getMessage()));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|in:obat,bhp',
            'harga_satuan' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $barang = Barang::findOrFail($id);
            $barang->update($request->all());
            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data barang berhasil diperbarui.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Tidak bisa memperbarui data. Error: ' . $th->getMessage()));
        }
    }

    public function softDelete($id)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::findOrFail($id);
            $barang->delete();
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
            $barang = Barang::onlyTrashed()->findOrFail($id);
            $barang->restore();
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
            $barang = Barang::onlyTrashed()->findOrFail($id);
            $barang->forceDelete();
            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Data berhasil dihapus permanen.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal menghapus permanen. Error: ' . $th->getMessage()));
        }
    }
}


