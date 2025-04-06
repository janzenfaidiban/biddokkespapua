<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BarangController;

Route::prefix('barang')->group(function () {

    Route::controller(BarangController::class)->group(function() {

        // index
        Route::get('/', 'index')->name('admin.barang.index');

        // trash
        Route::get('/trash', 'index')->name('admin.barang.trash');

        // create
        Route::get('/{jemaat_id}/create', 'create')->name('admin.barang.create');

        // store
        Route::post('/store', 'store')->name('admin.barang.store');

        // show
        Route::get('/{id}/detail', 'show')->name('admin.barang.show');

        // edit
        Route::get('/{id}/ubah', 'edit')->name('admin.barang.edit');

        // edit password
        Route::get('/{id}/edit/password', 'edit_password')->name('admin.barang.edit.password');

        // update
        Route::put('/{id}/update', 'update')->name('admin.barang.update');

        // update password
        Route::put('/{id}/update/password', 'update_password')->name('admin.barang.update.password');

        // destroy | SoftDelete > pindahkan ke tempat sampah
        Route::delete('/{id}/softDelete', 'softDelete')->name('admin.barang.softDelete');

        // restore | Backup > kembalikan atau keluarkan dari tempat sampah
        Route::put('/{id}/restore', 'restore')->name('admin.barang.restore');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('/{id}/forceDelete', 'forceDelete')->name('admin.barang.forceDelete');

    });

});
