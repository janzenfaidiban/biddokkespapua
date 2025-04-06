<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UsulanBarangController;

Route::prefix('usulanbarang')->group(function () {

    Route::controller(UsulanBarangController::class)->group(function() {

        // index
        Route::get('/', 'index')->name('admin.usulanbarang.index');

        // trash
        Route::get('/trash', 'index')->name('admin.usulanbarang.trash');

        // create
        Route::get('/{jemaat_id}/create', 'create')->name('admin.usulanbarang.create');

        // store
        Route::post('/store', 'store')->name('admin.usulanbarang.store');

        // show
        Route::get('/{id}/detail', 'show')->name('admin.usulanbarang.show');

        // edit
        Route::get('/{id}/ubah', 'edit')->name('admin.usulanbarang.edit');

        // edit password
        Route::get('/{id}/edit/password', 'edit_password')->name('admin.usulanbarang.edit.password');

        // update
        Route::put('/{id}/update', 'update')->name('admin.usulanbarang.update');

        // update password
        Route::put('/{id}/update/password', 'update_password')->name('admin.usulanbarang.update.password');

        // destroy | SoftDelete > pindahkan ke tempat sampah
        Route::delete('/{id}/destroy', 'softDelete')->name('admin.usulanbarang.destroy');

        // restore | Backup > kembalikan atau keluarkan dari tempat sampah
        Route::put('/{id}/restore', 'restore')->name('admin.usulanbarang.restore');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('/{id}/ForceDelete', 'forceDelete')->name('admin.usulanbarang.forceDelete');

    });

});
