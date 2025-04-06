<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BarangKeluarController;

Route::prefix('barangkeluar')->group(function () {

    Route::controller(BarangKeluarController::class)->group(function() {

        // index
        Route::get('/', 'index')->name('admin.barangkeluar.index');

        // trash
        Route::get('/trash', 'index')->name('admin.barangkeluar.trash');

        // create
        Route::get('/{jemaat_id}/create', 'create')->name('admin.barangkeluar.create');

        // store
        Route::post('/store', 'store')->name('admin.barangkeluar.store');

        // show
        Route::get('/{id}/detail', 'show')->name('admin.barangkeluar.show');

        // edit
        Route::get('/{id}/ubah', 'edit')->name('admin.barangkeluar.edit');

        // edit password
        Route::get('/{id}/edit/password', 'edit_password')->name('admin.barangkeluar.edit.password');

        // update
        Route::put('/{id}/update', 'update')->name('admin.barangkeluar.update');

        // update password
        Route::put('/{id}/update/password', 'update_password')->name('admin.barangkeluar.update.password');

        // destroy | SoftDelete > pindahkan ke tempat sampah
        Route::delete('/{id}/destroy', 'softDelete')->name('admin.barangkeluar.destroy');

        // restore | Backup > kembalikan atau keluarkan dari tempat sampah
        Route::put('/{id}/restore', 'restore')->name('admin.barangkeluar.restore');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('/{id}/ForceDelete', 'forceDelete')->name('admin.barangkeluar.forceDelete');

    });

});
