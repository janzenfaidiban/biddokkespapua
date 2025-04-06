<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\StatusPernikahanController;

    Route::controller(StatusPernikahanController::class)->group(function(){

        // index
        Route::get('statuspernikahan','index')->name('adminmaster.masterdata.statuspernikahan');

        // create
        Route::get('statuspernikahan/create','create')->name('adminmaster.masterdata.statuspernikahan.create');
        // store
        Route::post('statuspernikahan/store','store')->name('adminmaster.masterdata.statuspernikahan.store');
        // show
        Route::get('statuspernikahan/{id}/detail','show')->name('adminmaster.masterdata.statuspernikahan.show');

        // edit
        Route::get('statuspernikahan/{id}/edit','edit')->name('adminmaster.masterdata.statuspernikahan.edit');

        // update
        Route::put('statuspernikahan/{id}/update', 'update')->name('adminmaster.masterdata.statuspernikahan.update');
    
        // destroy
        Route::delete('statuspernikahan/{id}/destroy','destroy')->name('adminmaster.masterdata.statuspernikahan.destroy');
    
        // trash
        Route::get('statuspernikahan/trash','index')->name('adminmaster.masterdata.statuspernikahan.trash');
    
        // restore
        Route::put('statuspernikahan/{id}/restore','restore')->name('adminmaster.masterdata.statuspernikahan.restore');
    
        // delete
        Route::delete('statuspernikahan/{id}/delete','delete')->name('adminmaster.masterdata.statuspernikahan.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('statuspernikahan/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.statuspernikahan.forceDelete');

    });