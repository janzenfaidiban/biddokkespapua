<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WilayahController;

    Route::controller(WilayahController::class)->group(function(){

        // index
        Route::get('wilayah','index')->name('wilayah.index');

        // create
        Route::get('wilayah/tambah','create')->name('wilayah.create');

        // store
        Route::post('wilayah/store','store')->name('wilayah.store');

        // show
        Route::get('wilayah/{id}/detail','show')->name('wilayah.show');

        // edit
        Route::get('wilayah/{id}/ubah','edit')->name('wilayah.edit');

        // edit password
         Route::get('wilayah/{id}/edit/password','edit_password')->name('wilayah.edit.password');

        // update
        Route::put('wilayah/{id}/update','update')->name('wilayah.update');

        // update password
        Route::put('wilayah/{id}/update/password','update_password')->name('wilayah.update.password');

        // destroy
        Route::get('wilayah/{id}/hapus','destroy')->name('wilayah.delete');

        // trash
        Route::get('wilayah/tempat-sampah','trash')->name('wilayah.trash');

        // restore
        Route::put('wilayah/{id}/restore','restore')->name('wilayah.restore');

        // delete
        Route::delete('wilayah/{id}/delete','delete')->name('wilayah.destroy');


        Route::get('wilayah/tempat-sampah', 'sampah')->name('wilayah.sampah');

        // Delete Permanent
        Route::delete('wilayah/{id}/ForceDelete','ForceDelete')->name('wilayah.ForceDelete');

    });
