<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\GelarDepanController;

    Route::controller(GelarDepanController::class)->group(function(){

        // index
        Route::get('gelardepan','index')->name('adminmaster.masterdata.gelardepan');

        // create
        Route::get('gelardepan/create','create')->name('adminmaster.masterdata.gelardepan.create');
        // store
        Route::post('gelardepan/store','store')->name('adminmaster.masterdata.gelardepan.store');
        // show
        Route::get('gelardepan/{id}/detail','show')->name('adminmaster.masterdata.gelardepan.show');

        // edit
        Route::get('gelardepan/{id}/edit','edit')->name('adminmaster.masterdata.gelardepan.edit');

        // update
        Route::put('gelardepan/{id}/update', 'update')->name('adminmaster.masterdata.gelardepan.update');
    
        // destroy
        Route::delete('gelardepan/{id}/destroy','destroy')->name('adminmaster.masterdata.gelardepan.destroy');
    
        // trash
        Route::get('gelardepan/trash','index')->name('adminmaster.masterdata.gelardepan.trash');
    
        // restore
        Route::put('gelardepan/{id}/restore','restore')->name('adminmaster.masterdata.gelardepan.restore');
    
        // delete
        Route::delete('gelardepan/{id}/delete','delete')->name('adminmaster.masterdata.gelardepan.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('gelardepan/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.gelardepan.forceDelete');

    });