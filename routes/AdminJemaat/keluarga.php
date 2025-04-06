<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminJemaat\KeluargaController;

    Route::controller(KeluargaController::class)->group(function(){

        // index | keluarga
        Route::get('keluarga','index')->name('adminjemaat.keluarga.index');

        // trash | keluarga/tempat-sampah
        Route::get('keluarga/tempat-sampah','index')->name('adminjemaat.keluarga.trash');

        // create | keluarga/create
        Route::get('keluarga/{jemaat_id}/tambah','create')->name('adminjemaat.keluarga.create');

        // store
        Route::post('keluarga/store','store')->name('adminjemaat.keluarga.store');

        // show
        Route::get('keluarga/{id}/detail','show')->name('adminjemaat.keluarga.show');

        // edit
        Route::get('keluarga/{id}/ubah','edit')->name('adminjemaat.keluarga.edit');

        // edit password
        Route::get('keluarga/{id}/edit/password','edit_password')->name('adminjemaat.keluarga.edit.password');

        // update
        Route::put('keluarga/{id}/update','update')->name('adminjemaat.keluarga.update');

        // update password
        Route::put('keluarga/{id}/update/password','update_password')->name('adminjemaat.keluarga.update.password');

        // destroy | SoftDelete > pindahkan ke tempat sampah
        Route::delete('keluarga/{id}/destroy','destroy')->name('adminjemaat.keluarga.destroy');

        // restore | Backup > kembalikan atau keluarkan dari tempat sampah
        Route::put('keluarga/{id}/restore','restore')->name('adminjemaat.keluarga.restore');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('keluarga/{id}/ForceDelete','forceDelete')->name('adminjemaat.keluarga.forceDelete');


        /*============================== ANGGOTA KELUARGA ====================================*/ 

        // keluarga/{no_kk}/anggota
        Route::get('keluarga/anggota/{no_kk}','anggota')->name('adminjemaat.keluarga.anggota.index');

        // trash | keluarga/anggota/tempat-sampah
        Route::get('keluarga/anggota/{no_kk}/tempat-sampah','anggota')->name('adminjemaat.keluarga.anggota.trash');

        // // keluarga/{no_kk}/anggota
        // Route::get('keluarga/{no_kk}/anggota','anggota')->name('adminjemaat.keluarga.create.anggota');

        // keluarga/{no_kk}/anggota/tambah
        Route::get('keluarga/anggota/{no_kk}/tambah','anggotaCreate')->name('adminjemaat.keluarga.anggota.create');

        // keluarga/anggota/store
        Route::post('keluarga/anggota/store','anggotaStore')->name('adminjemaat.keluarga.anggota.store');

        // keluarga/anggota/show
        Route::get('keluarga/anggota/{id}/detail','anggotaEdit')->name('adminjemaat.keluarga.anggota.show');

        // keluarga/anggota/edit
        Route::get('keluarga/anggota/{id}/ubah','anggotaEdit')->name('adminjemaat.keluarga.anggota.edit');
        
        // keluarga/anggota/update
        Route::put('keluarga/anggota/{id}/update','anggotaUpdate')->name('adminjemaat.keluarga.anggota.update');

        // keluarga/anggota/destroy
        Route::delete('keluarga/anggota/{id}/destroy','anggotaDestroy')->name('adminjemaat.keluarga.anggota.destroy');

        // keluarga/anggota/resotre
        Route::put('keluarga/anggota/{id}/restore','anggotaRestore')->name('adminjemaat.keluarga.anggota.restore');

        // keluarga/anggota/forseDelete
        Route::delete('keluarga/anggota/{id}/ForceDelete','anggotaForceDelete')->name('adminjemaat.keluarga.anggota.forceDelete');

    });
