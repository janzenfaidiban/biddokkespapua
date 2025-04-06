<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\PendidikanTerakhirController;

    Route::controller(PendidikanTerakhirController::class)->group(function(){

        // index
        Route::get('pendidikanterakhir','index')->name('adminmaster.masterdata.pendidikanterakhir');

        // create
        Route::get('pendidikanterakhir/create','create')->name('adminmaster.masterdata.pendidikanterakhir.create');
        // store
        Route::post('pendidikanterakhir/store','store')->name('adminmaster.masterdata.pendidikanterakhir.store');
        // show
        Route::get('pendidikanterakhir/{id}/detail','show')->name('adminmaster.masterdata.pendidikanterakhir.show');

        // edit
        Route::get('pendidikanterakhir/{id}/edit','edit')->name('adminmaster.masterdata.pendidikanterakhir.edit');

        // update
        Route::put('pendidikanterakhir/{id}/update', 'update')->name('adminmaster.masterdata.pendidikanterakhir.update');
    
        // destroy
        Route::delete('pendidikanterakhir/{id}/destroy','destroy')->name('adminmaster.masterdata.pendidikanterakhir.destroy');
    
        // trash
        Route::get('pendidikanterakhir/trash','index')->name('adminmaster.masterdata.pendidikanterakhir.trash');
    
        // restore
        Route::put('pendidikanterakhir/{id}/restore','restore')->name('adminmaster.masterdata.pendidikanterakhir.restore');
    
        // delete
        Route::delete('pendidikanterakhir/{id}/delete','delete')->name('adminmaster.masterdata.pendidikanterakhir.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('pendidikanterakhir/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.pendidikanterakhir.forceDelete');

    });