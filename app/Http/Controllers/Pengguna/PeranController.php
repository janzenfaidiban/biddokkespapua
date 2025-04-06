<?php

namespace App\Http\Controllers\AdminSinode\Pengguna;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PeranController extends Controller
{
    
    public function index()
    {
        // just some samples datas
        $datas = [
            [
                'id'=> 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'id'=> 2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'id'=> 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
        ];

        // dd($datas);

        return view('AdminSinode.pengguna.peran.index', compact('datas'));
    }

    // create
    public function create()
    {
        // 
        return 'pengguna > create';
    }

    // store
    public function store(Request $request)
    {
        // 
        return 'pengguna > store';
    }

    // show
    public function show($id)
    {
        // 
        return 'pengguna > show';
    }

    // edit
    public function edit($id)
    {
        // 
        return 'pengguna > edit';
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
        return 'pengguna > destroy';
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
