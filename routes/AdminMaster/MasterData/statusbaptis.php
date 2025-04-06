<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\StatusBaptisController;

    Route::controller(StatusBaptisController::class)->group(function(){

        // index
        Route::get('statusbaptis','index')->name('adminmaster.masterdata.statusbaptis');

        // create
        Route::get('statusbaptis/create','create')->name('adminmaster.masterdata.statusbaptis.create');
        // store
        Route::post('statusbaptis/store','store')->name('adminmaster.masterdata.statusbaptis.store');
        // show
        Route::get('statusbaptis/{id}/detail','show')->name('adminmaster.masterdata.statusbaptis.show');

        // edit
        Route::get('statusbaptis/{id}/edit','edit')->name('adminmaster.masterdata.statusbaptis.edit');

        // update
        Route::put('statusbaptis/{id}/update', 'update')->name('adminmaster.masterdata.statusbaptis.update');
    
        // destroy
        Route::delete('statusbaptis/{id}/destroy','destroy')->name('adminmaster.masterdata.statusbaptis.destroy');
    
        // trash
        Route::get('statusbaptis/trash','index')->name('adminmaster.masterdata.statusbaptis.trash');
    
        // restore
        Route::put('statusbaptis/{id}/restore','restore')->name('adminmaster.masterdata.statusbaptis.restore');
    
        // delete
        Route::delete('statusbaptis/{id}/delete','delete')->name('adminmaster.masterdata.statusbaptis.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('statusbaptis/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.statusbaptis.forceDelete');

    });