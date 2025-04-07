<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AnggotaController;

Route::prefix('anggota')->group(function () {

    Route::controller(AnggotaController::class)->group(function() {

        // index
        Route::get('/', 'index')->name('admin.anggota.index');

        // trash
        Route::get('/trash', 'index')->name('admin.anggota.trash');

        // create
        Route::get('/{jemaat_id}/create', 'create')->name('admin.anggota.create');

        // store
        Route::post('/store', 'store')->name('admin.anggota.store');

        // show
        Route::get('/{id}/detail', 'show')->name('admin.anggota.show');

        // edit
        Route::get('/{id}/ubah', 'edit')->name('admin.anggota.edit');

        // edit password
        Route::get('/{id}/edit/password', 'edit_password')->name('admin.anggota.edit.password');

        // update
        Route::put('/{id}/update', 'update')->name('admin.anggota.update');

        // update password
        Route::put('/{id}/update/password', 'update_password')->name('admin.anggota.update.password');

        // destroy | SoftDelete > pindahkan ke tempat sampah
        Route::delete('/{id}/destroy', 'softDelete')->name('admin.anggota.softDelete');

        // restore | Backup > kembalikan atau keluarkan dari tempat sampah
        Route::put('/{id}/restore', 'restore')->name('admin.anggota.restore');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('/{id}/ForceDelete', 'forceDelete')->name('admin.anggota.forceDelete');

    });

});
