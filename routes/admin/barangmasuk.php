<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BarangMasukController;

Route::prefix('barangmasuk')->group(function () {

    Route::controller(BarangMasukController::class)->group(function() {

        // index
        Route::get('/', 'index')->name('admin.barangmasuk.index');

        // trash
        Route::get('/trash', 'index')->name('admin.barangmasuk.trash');

        // create
        Route::get('/{jemaat_id}/create', 'create')->name('admin.barangmasuk.create');

        // store
        Route::post('/store', 'store')->name('admin.barangmasuk.store');

        // show
        Route::get('/{id}/detail', 'show')->name('admin.barangmasuk.show');

        // edit
        Route::get('/{id}/ubah', 'edit')->name('admin.barangmasuk.edit');

        // edit password
        Route::get('/{id}/edit/password', 'edit_password')->name('admin.barangmasuk.edit.password');

        // update
        Route::put('/{id}/update', 'update')->name('admin.barangmasuk.update');

        // update password
        Route::put('/{id}/update/password', 'update_password')->name('admin.barangmasuk.update.password');

        // destroy | SoftDelete > pindahkan ke tempat sampah
        Route::delete('/{id}/destroy', 'softDelete')->name('admin.barangmasuk.destroy');

        // restore | Backup > kembalikan atau keluarkan dari tempat sampah
        Route::put('/{id}/restore', 'restore')->name('admin.barangmasuk.restore');

        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('/{id}/ForceDelete', 'forceDelete')->name('admin.barangmasuk.forceDelete');

    });

});
