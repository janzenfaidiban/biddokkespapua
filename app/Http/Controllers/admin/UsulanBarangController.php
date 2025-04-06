<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// models
use App\Models\User;

class UsulanBarangController extends Controller
{
      
    // index
    public function index()
    {
        
        // teks untuk judul dan deskripsi halaman
        $pageTitle = 'Usulan Barang dari Poliklinik';
        $pageDescription = '...';
    
        return view('admin.usulanbarang.index', compact(
            'pageTitle',
            'pageDescription'
        ));
    }



}
