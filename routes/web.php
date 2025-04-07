<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// siteInfo 
use App\Http\Controllers\SiteInfoController as SiteInfoController;

// admin
use App\Http\Controllers\admin\DasborController as AdminDasborController;

// operator
use App\Http\Controllers\admin\DasborController as OperatorDasborController;

// theme setups
use App\Http\Controllers\ThemeController;

Route::post('/update-theme', [ThemeController::class, 'updateTheme'])->name('update.theme');



Route::group(['middleware' => ['auth']], function () {

    // Redirect setelah login berdasarkan role
    Route::get('/', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect('/admin/dasbor');
        } elseif ($user->hasRole('pimpinan')) {
            return redirect('/pimpinan/dasbor');
        } 

        return redirect('/login'); // Default jika tidak ada role
    });


    // admin
    // routes untuk admin
    Route::group(['middleware' => ['role:admin'], 'prefix' => 'admin'], function () {
        
        // dasbor
        Route::get('/', [AdminDasborController::class, 'index'])->name('admin.dasbor');
        Route::get('/dasbor', [AdminDasborController::class, 'index'])->name('admin.dasbor');
        
        // profil
        Route::get('/profil', [AdminDasborController::class, 'profil'])->name('admin.profil');

        
        require 'admin/anggota.php';

    });
    

    // operator
    // routes untuk operator
    Route::group(['middleware' => ['role:operator'], 'prefix' => 'operator'], function () {
        
        // dasbor
        Route::get('/', [OperatorDasborController::class, 'index'])->name('operator.dasbor');
        Route::get('/dasbor', [OperatorDasborController::class, 'index'])->name('operator.dasbor');
        
        // profil
        Route::get('/profil', [OperatorDasborController::class, 'profil'])->name('operator.profil');

    });








    // Routes untuk Admin Master
    Route::group(['middleware' => ['role:adminmaster'], 'prefix' => 'adminmaster'], function () {

        // beranda
        Route::get('/', [BerandaAdminMasterController::class, 'index'])->name('adminmaster.beranda');
        
        // siteInfo
        Route::get('/faq', [SiteInfoController::class, 'faq'])->name('adminmaster.faq');
        Route::get('/panduan', [SiteInfoController::class, 'panduan'])->name('adminmaster.panduan');
        Route::get('/peta-situs', [SiteInfoController::class, 'petaSitus'])->name('adminmaster.petaSitus');
        Route::get('/hak-cipta', [SiteInfoController::class, 'hakCipta'])->name('adminmaster.hakCipta');
        Route::get('/syarat-ketentuan', [SiteInfoController::class, 'syaratKetentuan'])->name('adminmaster.syaratKetentuan');

        // main navigations
        require 'AdminMaster/klasis.php';
        require 'AdminMaster/jemaat.php';
        require 'AdminMaster/profil.php';

    });















    // Routes untuk Admin Klasis
    Route::group(['middleware' => ['role:adminklasis'], 'prefix' => 'adminklasis'], function () {

        // beranda
        Route::get('/', [BerandaAdminKlasisController::class, 'index'])->name('adminklasis.beranda');
        
        // siteInfo
        Route::get('/faq', [SiteInfoController::class, 'faq'])->name('adminklasis.faq');
        Route::get('/panduan', [SiteInfoController::class, 'panduan'])->name('adminklasis.panduan');
        Route::get('/peta-situs', [SiteInfoController::class, 'petaSitus'])->name('adminklasis.petaSitus');
        Route::get('/hak-cipta', [SiteInfoController::class, 'hakCipta'])->name('adminklasis.hakCipta');
        Route::get('/syarat-ketentuan', [SiteInfoController::class, 'syaratKetentuan'])->name('adminklasis.syaratKetentuan');

        // main navigations        
        require 'AdminKlasis/jemaat.php';
        require 'AdminKlasis/keluarga.php';
        require 'AdminKlasis/profil.php';

    });

















    // Routes untuk Admin Jemaat
    Route::group(['middleware' => ['role:adminjemaat'], 'prefix' => 'adminjemaat'], function () {
        
        Route::get('/', [BerandaAdminJemaatController::class, 'index'])->name('adminjemaat.beranda');
        
        // siteInfo
        Route::get('/faq', [SiteInfoController::class, 'faq'])->name('adminjemaat.faq');
        Route::get('/panduan', [SiteInfoController::class, 'panduan'])->name('adminjemaat.panduan');
        Route::get('/peta-situs', [SiteInfoController::class, 'petaSitus'])->name('adminjemaat.petaSitus');
        Route::get('/hak-cipta', [SiteInfoController::class, 'hakCipta'])->name('adminjemaat.hakCipta');
        Route::get('/syarat-ketentuan', [SiteInfoController::class, 'syaratKetentuan'])->name('adminjemaat.syaratKetentuan');



        
        require 'AdminJemaat/keluarga.php';
        require 'AdminJemaat/profil.php';

    });














    

});

Auth::routes();

