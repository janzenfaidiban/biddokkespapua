<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;

// models
use App\Models\User;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    public function index()
    {
        $search = request()->search;

        if (request()->segment(3) == 'trash') {
            $query = Anggota::onlyTrashed();
        } else {
            $query = Anggota::query();
        }

        if ($search) {
            $query->where('nama_lengkap', 'LIKE', '%' . $search . '%');
        }

        $datas = $query->orderBy('nama_lengkap', 'asc')->get();

        $totalOnlyTrashed = Anggota::onlyTrashed()->count();
        $totalAll = Anggota::withTrashed()->count();

        $pageTitle = 'Data Anggota';
        $pageDescription = 'Daftar anggota yang terdaftar.';

        return view('admin.anggota.index', compact(
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
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email',
            'no_hp' => 'required|string|max:20',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            Anggota::create($data);

            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data anggota berhasil ditambahkan.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Tidak bisa menyimpan data. Error: ' . $th->getMessage()));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email,' . $id,
            'no_hp' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $anggota = Anggota::findOrFail($id);
            $anggota->update($request->all());

            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Berhasil! Data anggota berhasil diperbarui.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal! Tidak bisa memperbarui data. Error: ' . $th->getMessage()));
        }
    }

    public function softDelete($id)
    {
        DB::beginTransaction();
        try {
            $anggota = Anggota::findOrFail($id);
            $anggota->delete();
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
            $anggota = Anggota::onlyTrashed()->findOrFail($id);
            $anggota->restore();
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
            $anggota = Anggota::onlyTrashed()->findOrFail($id);
            $anggota->forceDelete();
            DB::commit();
            return redirect()->back()->with(BootstrapAlerts::addSuccess('Data berhasil dihapus permanen.'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(BootstrapAlerts::addError('Gagal menghapus permanen. Error: ' . $th->getMessage()));
        }
    }
}
