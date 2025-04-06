<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\GelarBelakangController;

    Route::controller(GelarBelakangController::class)->group(function(){

        // index
        Route::get('gelarbelakang','index')->name('adminmaster.masterdata.gelarbelakang');

        // create
        Route::get('gelarbelakang/create','create')->name('adminmaster.masterdata.gelarbelakang.create');
        // store
        Route::post('gelarbelakang/store','store')->name('adminmaster.masterdata.gelarbelakang.store');
        // show
        Route::get('gelarbelakang/{id}/detail','show')->name('adminmaster.masterdata.gelarbelakang.show');

        // edit
        Route::get('gelarbelakang/{id}/edit','edit')->name('adminmaster.masterdata.gelarbelakang.edit');

        // update
        Route::put('gelarbelakang/{id}/update', 'update')->name('adminmaster.masterdata.gelarbelakang.update');
    
        // destroy
        Route::delete('gelarbelakang/{id}/destroy','destroy')->name('adminmaster.masterdata.gelarbelakang.destroy');
    
        // trash
        Route::get('gelarbelakang/trash','index')->name('adminmaster.masterdata.gelarbelakang.trash');
    
        // restore
        Route::put('gelarbelakang/{id}/restore','restore')->name('adminmaster.masterdata.gelarbelakang.restore');
    
        // delete
        Route::delete('gelarbelakang/{id}/delete','delete')->name('adminmaster.masterdata.gelarbelakang.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('gelarbelakang/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.gelarbelakang.forceDelete');

    });