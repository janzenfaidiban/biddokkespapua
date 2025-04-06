<?php

namespace App\Http\Controllers\AdminSinode\Jemaat;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Klasis;
use App\Models\Wilayah;
use App\Models\User;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;


class JemaatController extends Controller
{
    // index
    public function index()
    {
        $datas = Jemaat::where([
            ['nama_jemaat', '!=', Null],
            [function ($query) {
                if (($s = request()->s)) {
                    $query->orWhere('nama_jemaat', 'LIKE', '%' . $s . '%');
                }
            }]
        ])->with('klasis')->orderBy('id', 'asc')->paginate(50);
        return view('AdminSinode.jemaat.index', compact('datas'))->with('no', (request()->input('page', 1) - 1) * 10);
    }

    // create
    public function create()
    {
        $wilayah = Wilayah::orderBy('wilayah','asc')->get();
        $klasis = Klasis::orderBy('nama_klasis','asc')->get();
        return view('AdminSinode.jemaat.form',compact('wilayah', 'klasis'));
    }

    // store
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jemaat' => 'required',
            'wilayah_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
        ], [
            'nama_jemaat.required' => 'Data ini wajib dilengkapi',
            'wilayah_id.required' => 'Data ini wajib dilengkapi',
            'email.required' => 'Data ini wajib dilengkapi',
            'email.email' => 'Format email salah',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Data ini wajib dilengkapi',
            'password.min' => 'Kata sandi harus minimal 8 karakter',
        ]);

        try {

            // Data User
            $user = New User();
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->name = $validatedData['nama_jemaat'];
            $user->avatar = 'assets/images/users/user-man-1.png';
            $user->save();

            // Data Jemaat
            $jemaat = new Jemaat();
            $jemaat->user_id = $user->id;
            $jemaat->wilayah_id = $validatedData['wilayah_id'];
            $jemaat->nama_jemaat = $validatedData['nama_jemaat'];
            $jemaat->alamat = $request->alamat;
            $jemaat->profil = $request->profil;

            $jemaat->save();
            $user->assignRole('adminjemaat');

            return redirect()->route('sinode.jemaat')
                ->with('modal_success', 'Berhasil!')
                ->with('modal_success_icon', '<i class="fas fa-check-circle"></i>')
                ->with('modal_success_desc', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('sinode.jemaat')
                ->with('modal_success', 'Berhasil!')
                ->with('modal_success_icon', '<i class="fas fa-check-circle"></i>')
                ->with('modal_success_desc', 'Data berhasil ditambahkan');
        }
    }

    // show
    public function show($id)
    {
        $data = Jemaat::where('id', $id)->first();
        $wilayah = Wilayah::orderBy('wilayah','asc')->get();
        return view('AdminSinode.jemaat.form', compact('data','wilayah'));
    }

    // edit
    public function edit($id)
    {
        $data = Jemaat::where('id', $id)->first();
       
        $wilayah = Wilayah::orderBy('wilayah','asc')->get();
        return view('AdminSinode.jemaat.form', compact('data','wilayah'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
        [
            'nama_jemaat' => 'required',
        ], 
        [
            'nama_jemaat.required' => 'Data ini wajib dilengkapi',
        ]);

        try {

            // find jemaat data
            $jemaat = Jemaat::find($id);
            $user_id = $jemaat['user_id'];

            
            // find user data
            $user = User::find($user_id);

            // Data Jemaat
            $jemaat->user_id = $user['id'];            
            $jemaat->wilayah_id = $request['wilayah_id'];
            $jemaat->nama_jemaat = $validatedData['nama_jemaat'];
            $jemaat->alamat = $request->alamat;
            $jemaat->profil = $request->profil;

            // Data User
            if ($user->email != $request['email']) {
                $user->email = $request['email'];
            }

            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            $user->name = $validatedData['nama_jemaat'];
            $user->avatar = 'assets/images/users/user-man-1.png';

            $user->update();

            $jemaat->update();
            
            return redirect()->route('sinode.jemaat')
                ->with('modal_success', 'Berhasil!')
                ->with('modal_success_icon', '<i class="fas fa-check-circle"></i>')
                ->with('modal_success_desc', 'Nama Jemaat berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('sinode.jemaat')
                ->with('modal_success', 'Berhasil!')
                ->with('modal_success_icon', '<i class="fas fa-check-circle"></i>')
                ->with('modal_success_desc', 'Nama Jemaat berhasil diupdate');
        }
    }

    // trash or tempat sampah
    public function trash()
    {
        $datas = Jemaat::withTrashed()->where([
            ['deleted_at', '!=', Null],
            [function ($query) {
                if (($s = request()->s)) {
                    $query->orWhere('nama_jemaat', 'LIKE', '%' . $s . '%');
                }
            }]
        ])->orderBy('id', 'asc')->paginate(50);
        return view('AdminSinode.jemaat.index', compact('datas'))->with('no', (request()->input('page', 1) - 1) * 10); 
    }

    // delete (go to trash)
    public function delete($id)
    {
        $data = Jemaat::withTrashed()->find($id);
        // $user = User::find($data->user->id);
        // dd($user);
        // $user->delete();
        $data->delete();
        return redirect()->route('sinode.jemaat')
            ->with('modal_success', 'Berhasil!')
            ->with('modal_success_icon', '<i class="fas fa-trash"></i>')
            ->with('modal_success_desc', 'Data telah dipindahkan ke tempat sampah');

    }
    
    // restore
    public function restore($id)
    {
        Jemaat::withTrashed()->find($id)->restore();
        return redirect()->route('sinode.jemaat')
            ->with('modal_success', 'Berhasil!')
            ->with('modal_success_icon', '<i class="fas fa-check-circle"></i>')
            ->with('modal_success_desc', 'Data berhasil dikembalikan');
    }

    // destroy or force delete
    public function destroy($id)
    {
        $data = Jemaat::withTrashed()->find($id);
        $user_id = $data->user_id;
        $user = User::find($user_id);
        if ($user) {
            $user->forceDelete();
        }
        $data->forceDelete();
        return redirect()->route('sinode.jemaat.trash')
            ->with('modal_success', 'Berhasil!')
            ->with('modal_success_icon', '<i class="fas fa-trash"></i>')
            ->with('modal_success_desc', 'Data telah dihapus secara permanen');
    }

}
