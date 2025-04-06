<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\KlasisController;

    Route::controller(KlasisController::class)->group(function(){

        // index
        Route::get('klasis','index')->name('adminmaster.klasis.index');

        // create
        Route::get('klasis/create','create')->name('adminmaster.klasis.create');

        // store
        Route::post('klasis/store','store')->name('adminmaster.klasis.store');

        // show
        Route::get('klasis/{id}/detail','show')->name('adminmaster.klasis.show');

        // edit
        Route::get('klasis/{id}/edit','edit')->name('adminmaster.klasis.edit');

        // edit password
         Route::get('klasis/{id}/edit/password','edit_password')->name('adminmaster.klasis.edit.password');

        // update
        Route::put('klasis/{id}/update','update')->name('adminmaster.klasis.update');

        // update password
        Route::put('klasis/{id}/update/password','update_password')->name('adminmaster.klasis.update.password');

        // destroy
        Route::delete('klasis/{id}/destroy','destroy')->name('adminmaster.klasis.destroy');

        // trash
        Route::get('klasis/trash','index')->name('adminmaster.klasis.trash');

        // restore
        Route::put('klasis/{id}/restore','restore')->name('adminmaster.klasis.restore');

        // delete
        Route::delete('klasis/{id}/delete','delete')->name('adminmaster.klasis.delete');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('klasis/{id}/ForceDelete','forceDelete')->name('adminmaster.klasis.forceDelete');

        // delete images
       Route::delete('jemaat/{id}/delete-foto-kantor', 'deleteFotoKantor')->name('adminmaster.jemaat.delete.fotoKantor');
       Route::delete('jemaat/{id}/delete-foto-ketua-klasis', 'deleteFotoKetuaKlasis')->name('adminmaster.jemaat.delete.fotoKetuaKlasis');

       // delete files
       Route::delete('jemaat/{id}/delete-struktur-organisasi', 'deleteFileStrukturOrganisasi')->name('adminmaster.jemaat.delete.fileStrukturOrganisasi');
       Route::delete('jemaat/{id}/delete-sarana-prasarana', 'deleteFileSaranaPrasarana')->name('adminmaster.jemaat.delete.fileSaranaPrasarana');

    });
