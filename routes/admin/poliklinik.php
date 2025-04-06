<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PoliklinikController;

Route::prefix('poliklinik')->group(function () {

    Route::controller(PoliklinikController::class)->group(function() {

        // index
        Route::get('/', 'index')->name('admin.poliklinik.index');

        // trash
        Route::get('/trash', 'index')->name('admin.poliklinik.trash');

        // create
        Route::get('/{jemaat_id}/create', 'create')->name('admin.poliklinik.create');

        // store
        Route::post('/store', 'store')->name('admin.poliklinik.store');

        // show
        Route::get('/{id}/detail', 'show')->name('admin.poliklinik.show');

        // edit
        Route::get('/{id}/ubah', 'edit')->name('admin.poliklinik.edit');

        // edit password
        Route::get('/{id}/edit/password', 'edit_password')->name('admin.poliklinik.edit.password');

        // update
        Route::put('/{id}/update', 'update')->name('admin.poliklinik.update');

        // update password
        Route::put('/{id}/update/password', 'update_password')->name('admin.poliklinik.update.password');

        // destroy | SoftDelete > pindahkan ke tempat sampah
        Route::delete('/{id}/destroy', 'softDelete')->name('admin.poliklinik.softDelete');

        // restore | Backup > kembalikan atau keluarkan dari tempat sampah
        Route::put('/{id}/restore', 'restore')->name('admin.poliklinik.restore');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('/{id}/ForceDelete', 'forceDelete')->name('admin.poliklinik.forceDelete');

    });

});
