<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// models
use App\Models\User;

class DasborController extends Controller
{
      
    // index
    public function index()
    {
        
        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Dasbor';
        $pageDescription = 'Halaman utama sistem informasi ketika pengguna berhasil login. Menampilkan berbagai rekapan data hasil pengelolaan pada sistem informasi.';
    
        return view('admin.dasbor', compact(
            'pageTitle',
            'pageDescription'
            
        ));
    }



}
