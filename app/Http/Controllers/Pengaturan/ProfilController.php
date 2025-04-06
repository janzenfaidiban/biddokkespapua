<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{

    public function index()
    {
        $data = User::where('id',Auth::user()->id)->first();
        return  view('pengaturan.index', compact('data'));
    }
}
