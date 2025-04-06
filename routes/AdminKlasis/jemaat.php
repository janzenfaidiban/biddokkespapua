<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminKlasis\JemaatController;

Route::controller(JemaatController::class)->group(function(){

    // index
    Route::get('jemaat','index')->name('adminklasis.jemaat.index');

    // create
    Route::get('jemaat/create','create')->name('adminklasis.jemaat.create');

    // store
    Route::post('jemaat/store','store')->name('adminklasis.jemaat.store');

    // show
    Route::get('jemaat/{id}/detail','show')->name('adminklasis.jemaat.show');

    // edit
    Route::get('jemaat/{id}/edit','edit')->name('adminklasis.jemaat.edit');

    // edit password
    Route::get('jemaat/{id}/edit/password','edit_password')->name('adminklasis.jemaat.edit.password');

    // update
    Route::put('jemaat/{id}/update','update')->name('adminklasis.jemaat.update');

    // update password
    Route::put('jemaat/{id}/update/password','update_password')->name('adminklasis.jemaat.update.password');

    // destroy
    Route::delete('jemaat/{id}/destroy','destroy')->name('adminklasis.jemaat.destroy');

    // trash
    Route::get('jemaat/trash','index')->name('adminklasis.jemaat.trash');

    // restore
    Route::put('jemaat/{id}/restore','restore')->name('adminklasis.jemaat.restore');

    // delete
    Route::delete('jemaat/{id}/delete','delete')->name('adminklasis.jemaat.delete');

    // forceDelete | ForceDeletes > menghapus permanen dari database
    Route::delete('jemaat/{id}/ForceDelete','forceDelete')->name('adminklasis.jemaat.forceDelete');

    // delete images
    Route::delete('jemaat/{id}/delete-foto-gereja', 'deleteFotoGereja')->name('adminklasis.jemaat.delete.fotoGereja');
    Route::delete('jemaat/{id}/delete-foto-pendeta', 'deleteFotoPendeta')->name('adminklasis.jemaat.delete.fotoPendeta');
    Route::delete('jemaat/{id}/delete-foto-sekretaris', 'deleteFotoSekretarisJemaat')->name('adminklasis.jemaat.delete.fotoSekretarisJemaat');

    // delete files
    Route::delete('jemaat/{id}/delete-struktur-organisasi', 'deleteFileStrukturOrganisasi')->name('adminklasis.jemaat.delete.fileStrukturOrganisasi');
    Route::delete('jemaat/{id}/delete-sarana-prasarana', 'deleteFileSaranaPrasarana')->name('adminklasis.jemaat.delete.fileSaranaPrasarana');

});
