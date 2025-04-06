<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminKlasis\KeluargaController;

    Route::controller(KeluargaController::class)->group(function(){

        // index | keluarga
        Route::get('keluarga','index')->name('klasis.keluarga.index');

        // trash | keluarga/tempat-sampah
        Route::get('keluarga/tempat-sampah','index')->name('klasis.keluarga.trash');

        // create | keluarga/create
        Route::get('keluarga/{jemaat_id}/tambah','create')->name('klasis.keluarga.create');

        // store
        Route::post('keluarga/store','store')->name('klasis.keluarga.store');

        // show
        Route::get('keluarga/{id}/detail','show')->name('klasis.keluarga.show');

        // show & anggota keluarga
        Route::get('keluarga/{no_kk}/anggota','anggota')->name('klasis.keluarga.show.anggota');

        // edit
        Route::get('keluarga/{id}/ubah','edit')->name('klasis.keluarga.edit');

        // edit password
         Route::get('keluarga/{id}/edit/password','edit_password')->name('klasis.keluarga.edit.password');

        // update
        Route::put('keluarga/{id}/update','update')->name('klasis.keluarga.update');

        // update password
        Route::put('keluarga/{id}/update/password','update_password')->name('klasis.keluarga.update.password');

        // destroy
        Route::delete('keluarga/{id}/destroy','destroy')->name('klasis.keluarga.destroy');

        // restore
        Route::put('keluarga/{id}/restore','restore')->name('klasis.keluarga.restore');

        // delete
        Route::delete('keluarga/{id}/delete','delete')->name('klasis.keluarga.delete');

        // Delete Permanent
        Route::delete('keluarga/{id}/ForceDelete','ForceDelete')->name('klasis.keluarga.ForceDelete');

    });
