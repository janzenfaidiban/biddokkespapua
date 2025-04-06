<?php

namespace App\Http\Controllers\AdminSinode\Pengaturan;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class KataSandiController extends Controller
{
    
    public function index()
    {
        return view('beranda.pengaturan.katasandi.index');
    }
}
