<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\JemaatController;

    Route::controller(JemaatController::class)->group(function(){

        // index
        Route::get('jemaat','index')->name('adminmaster.jemaat.index');

        // create
        Route::get('jemaat/create','create')->name('adminmaster.jemaat.create');

        // store
        Route::post('jemaat/store','store')->name('adminmaster.jemaat.store');

        // show
        Route::get('jemaat/{id}/detail','show')->name('adminmaster.jemaat.show');

        // edit
        Route::get('jemaat/{id}/edit','edit')->name('adminmaster.jemaat.edit');

        // edit password
         Route::get('jemaat/{id}/edit/password','edit_password')->name('adminmaster.jemaat.edit.password');

        // update
        Route::put('jemaat/{id}/update','update')->name('adminmaster.jemaat.update');

        // update password
        Route::put('jemaat/{id}/update/password','update_password')->name('adminmaster.jemaat.update.password');

        // destroy
        Route::delete('jemaat/{id}/destroy','destroy')->name('adminmaster.jemaat.destroy');

        // trash
        Route::get('jemaat/trash','index')->name('adminmaster.jemaat.trash');

        // restore
        Route::put('jemaat/{id}/restore','restore')->name('adminmaster.jemaat.restore');

        // delete
        Route::delete('jemaat/{id}/delete','delete')->name('adminmaster.jemaat.delete');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('jemaat/{id}/ForceDelete','forceDelete')->name('adminmaster.jemaat.forceDelete');

        // delete images
       Route::delete('jemaat/{id}/delete-foto-gereja', 'deleteFotoGereja')->name('adminmaster.jemaat.delete.fotoGereja');
       Route::delete('jemaat/{id}/delete-foto-pendeta', 'deleteFotoPendeta')->name('adminmaster.jemaat.delete.fotoPendeta');
       Route::delete('jemaat/{id}/delete-foto-sekretaris', 'deleteFotoSekretarisJemaat')->name('adminmaster.jemaat.delete.fotoSekretarisJemaat');

       // delete files
       Route::delete('jemaat/{id}/delete-struktur-organisasi', 'deleteFileStrukturOrganisasi')->name('adminmaster.jemaat.delete.fileStrukturOrganisasi');
       Route::delete('jemaat/{id}/delete-sarana-prasarana', 'deleteFileSaranaPrasarana')->name('adminmaster.jemaat.delete.fileSaranaPrasarana');

    });
