<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// models
use App\Models\User;

class BarangKeluarController extends Controller
{
      
    // index
    public function index()
    {
        
        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Barang Keluar';
        $pageDescription = '...';
    
        return view('admin.barangkeluar.index', compact(
            'pageTitle',
            'pageDescription'
        ));
    }



}
