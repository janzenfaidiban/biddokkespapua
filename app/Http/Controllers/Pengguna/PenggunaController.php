<?php

namespace App\Http\Controllers\AdminSinode\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Klasis;
use App\Models\Jemaat;
use App\Models\Roles;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    // list
    public function index()
    {

        $datas = User::all();
        return view('AdminSinode.pengguna.AdminSinode.index', compact('datas'));
    }

    // list of 'admin master'
    public function indexAdminSinode() {
        $datas = User::role('AdminSinode')->get();
        return view('AdminSinode.pengguna.AdminSinode.index', compact('datas'));

    }

    // list of 'admin klasis'
    public function indexAdminKlasis() {
        $datas = User::role('adminklasis')->get();
        return view('AdminSinode.pengguna.adminKlasis.index', compact('datas'));
    }

    // list of 'admin jemaat'
    public function indexAdminJemaat() {
        $datas = User::role('adminjemaat')->get();
        return view('AdminSinode.pengguna.adminJemaat.index', compact('datas'));

    }


    // create
    public function create()
    {
        $roles = Roles::all();
        return view('AdminSinode.pengguna.create', compact('roles'));
    }

    // store
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email'  => 'required|email|unique:users,email',
                'username'  => 'required|unique:users,username|lowercase|string|alpha_dash|min:6',
                'password' => 'required|confirmed|min:6',
            ],
            [
                'name.required' => '"Name" wajib dilengkapi',
                'email.email' => '"Email" tidak sesuai format yang benar',
                'email.unique' => '"Email" sudah terdaftar',

                // username validation alerts
                'username.required' => '"Username" wajib dilengkapi',
                'username.unique' => '"Username" ini sudah digunakan',
                'username.alpha_dash' => '"Username" tidak boleh ada spasi',
                'username.min' => '"Username" harus lebih dari 6 karakter',
                'username.lowercase' => '"Username" harus huruf kecil',
                // password validation alerts
                'password.required' => '"Password" wajib dilengkapi',
                'password.confirmed' => 'Password tidak cocok',
                'password.min' => 'Password harus lebih dari 6 karakter',
            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } else {
            try {
                $data = new User();

                $data->name = $request->name;
                $data->email = $request->email;
                $data->avatar = 'assets/images/users/user-man-1.png';
                $data->username = Str::slug($request->username);
                $data->password = bcrypt($request->password);
                $data->assignRole($request->role);

                $data->save();

                return redirect()->route('sinode.pengguna')->with(BootstrapAlerts::addSuccess('Berhasil! Data telah ditambahkan ke database'));
            } catch (\Throwable $th) {
                return redirect()->route('sinode.pengguna.create')->with(BootstrapAlerts::addError('Gagal! Data gagal ditambahkan ke database'));
            }
        }
    }

    // show
    public function show($id)
    {
        $roles = Roles::all();
        $data = User::where('id', $id)->first();
        // dd(implode(",",$data->roles()->pluck('name')->toArray()));
        return view('AdminSinode.pengguna.edit', compact('roles','data'));
    }

    // edit
    public function edit($id)
    {
        $roles = Roles::all();
        $data = User::where('id', $id)->first();
        return view('AdminSinode.pengguna.edit', compact('roles','data'));
    }

    // update
    public function update(Request $request, $id)
    {
        //
        return 'pengguna > update';
    }

    // destroy
    public function destroy($id)
    {
        //
        return view('AdminSinode.pengguna.destroy');
    }

    // trash
    public function trash($id)
    {
        //
        return 'pengguna > trash';
    }

    // restore
    public function restore($id)
    {
        //
        return 'pengguna > restore';
    }

    // delete
    public function delete($id)
    {
        //
        return 'pengguna > delete';
    }

}
