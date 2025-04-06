<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// models
use App\Models\User;

class BarangMasukController extends Controller
{
      
    // index
    public function index()
    {
        
        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Barang Masuk';
        $pageDescription = '...';
    
        return view('admin.barangmasuk.index', compact(
            'pageTitle',
            'pageDescription'
        ));
    }



}
