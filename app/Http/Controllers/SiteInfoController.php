<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SiteInfoController extends Controller
{

    // faq
    public function faq()
    {
        $pageTitle = 'FAQ'; 
        $pageDescription = 'Pertanyaan-pertanyaan yang paling sering ditanyakan oleh pengguna berkaitan dengan penggunaan sistem database online.'; 
        return view('siteInfo.faq', compact('pageTitle', 'pageDescription'));
    }

    // panduan
    public function panduan()
    {
        $pageTitle = 'Panduan'; 
        $pageDescription = 'Panduan penggunaan sistem database online yang berisi langkah-langkah, fitur, dan tips untuk memaksimalkan pengalaman pengguna.'; 
        return view('siteInfo.panduan', compact('pageTitle', 'pageDescription'));
    }

    // peta situs
    public function petaSitus()
    {
        $pageTitle = 'Peta Situs'; 
        $pageDescription = 'Struktur dan daftar halaman dalam sistem database online untuk membantu pengguna dalam menavigasi situs dengan mudah.'; 
        return view('siteInfo.petaSitus', compact('pageTitle', 'pageDescription'));
    }

    // hak cipta
    public function hakCipta()
    {
        $pageTitle = 'Hak Cipta'; 
        $pageDescription = 'Informasi mengenai hak cipta, kepemilikan konten, dan kebijakan penggunaan data dalam sistem database online.'; 
        return view('siteInfo.hakCipta', compact('pageTitle', 'pageDescription'));
    }

    // syarat dan ketentuan
    public function syaratKetentuan()
    {
        $pageTitle = 'Syarat dan Ketentuan'; 
        $pageDescription = 'Ketentuan penggunaan sistem database online, termasuk aturan, kebijakan privasi, dan tanggung jawab pengguna.'; 
        return view('siteInfo.syaratKetentuan', compact('pageTitle', 'pageDescription'));
    }




}
