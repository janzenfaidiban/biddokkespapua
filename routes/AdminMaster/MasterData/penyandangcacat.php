<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\penyandangCacatController;

    Route::controller(penyandangCacatController::class)->group(function(){

        // index
        Route::get('penyandangcacat','index')->name('adminmaster.masterdata.penyandangcacat');

        // create
        Route::get('penyandangcacat/create','create')->name('adminmaster.masterdata.penyandangcacat.create');
        // store
        Route::post('penyandangcacat/store','store')->name('adminmaster.masterdata.penyandangcacat.store');
        // show
        Route::get('penyandangcacat/{id}/detail','show')->name('adminmaster.masterdata.penyandangcacat.show');

        // edit
        Route::get('penyandangcacat/{id}/edit','edit')->name('adminmaster.masterdata.penyandangcacat.edit');

        // update
        Route::put('penyandangcacat/{id}/update', 'update')->name('adminmaster.masterdata.penyandangcacat.update');
    
        // destroy
        Route::delete('penyandangcacat/{id}/destroy','destroy')->name('adminmaster.masterdata.penyandangcacat.destroy');
    
        // trash
        Route::get('penyandangcacat/trash','index')->name('adminmaster.masterdata.penyandangcacat.trash');
    
        // restore
        Route::put('penyandangcacat/{id}/restore','restore')->name('adminmaster.masterdata.penyandangcacat.restore');
    
        // delete
        Route::delete('penyandangcacat/{id}/delete','delete')->name('adminmaster.masterdata.penyandangcacat.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('penyandangcacat/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.penyandangcacat.forceDelete');

    });