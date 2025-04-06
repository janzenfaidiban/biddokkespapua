<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\StatusDomisiliController;

    Route::controller(StatusDomisiliController::class)->group(function(){

        // index
        Route::get('statusdomisili','index')->name('adminmaster.masterdata.statusdomisili');

        // create
        Route::get('statusdomisili/create','create')->name('adminmaster.masterdata.statusdomisili.create');
        // store
        Route::post('statusdomisili/store','store')->name('adminmaster.masterdata.statusdomisili.store');
        // show
        Route::get('statusdomisili/{id}/detail','show')->name('adminmaster.masterdata.statusdomisili.show');

        // edit
        Route::get('statusdomisili/{id}/edit','edit')->name('adminmaster.masterdata.statusdomisili.edit');

        // update
        Route::put('statusdomisili/{id}/update', 'update')->name('adminmaster.masterdata.statusdomisili.update');
    
        // destroy
        Route::delete('statusdomisili/{id}/destroy','destroy')->name('adminmaster.masterdata.statusdomisili.destroy');
    
        // trash
        Route::get('statusdomisili/trash','index')->name('adminmaster.masterdata.statusdomisili.trash');
    
        // restore
        Route::put('statusdomisili/{id}/restore','restore')->name('adminmaster.masterdata.statusdomisili.restore');
    
        // delete
        Route::delete('statusdomisili/{id}/delete','delete')->name('adminmaster.masterdata.statusdomisili.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('statusdomisili/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.statusdomisili.forceDelete');

    });