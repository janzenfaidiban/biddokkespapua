<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\StatusSidiController;

    Route::controller(StatusSidiController::class)->group(function(){

        // index
        Route::get('statussidi','index')->name('adminmaster.masterdata.statussidi');

        // create
        Route::get('statussidi/tambah','create')->name('adminmaster.masterdata.statussidi.create');

        // store
        Route::post('statussidi/store','store')->name('adminmaster.masterdata.statussidi.store');

        // show
        Route::get('statussidi/{id}/detail','show')->name('adminmaster.masterdata.statussidi.show');

        // edit
        Route::get('statussidi/{id}/ubah','edit')->name('adminmaster.masterdata.statussidi.edit');

        // update
        Route::put('statussidi/{id}/update', 'update')->name('adminmaster.masterdata.statussidi.update');
    
        // destroy
        Route::delete('statussidi/{id}/destroy','destroy')->name('adminmaster.masterdata.statussidi.destroy');
    
        // trash
        Route::get('statussidi/tempat-sampah','index')->name('adminmaster.masterdata.statussidi.trash');
    
        // restore
        Route::put('statussidi/{id}/restore','restore')->name('adminmaster.masterdata.statussidi.restore');
    
        // delete
        Route::delete('statussidi/{id}/delete','delete')->name('adminmaster.masterdata.statussidi.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('statussidi/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.statussidi.forceDelete');

    });
