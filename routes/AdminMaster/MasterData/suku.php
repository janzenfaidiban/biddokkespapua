<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\SukuController;

    Route::controller(SukuController::class)->group(function(){

        // index
        Route::get('suku','index')->name('adminmaster.masterdata.suku');

        // create
        Route::get('suku/create','create')->name('adminmaster.masterdata.suku.create');
        // store
        Route::post('suku/store','store')->name('adminmaster.masterdata.suku.store');
        // show
        Route::get('suku/{id}/detail','show')->name('adminmaster.masterdata.suku.show');

        // edit
        Route::get('suku/{id}/edit','edit')->name('adminmaster.masterdata.suku.edit');

        // update
        Route::put('suku/{id}/update', 'update')->name('adminmaster.masterdata.suku.update');
    
        // destroy
        Route::delete('suku/{id}/destroy','destroy')->name('adminmaster.masterdata.suku.destroy');
    
        // trash
        Route::get('suku/trash','index')->name('adminmaster.masterdata.suku.trash');
    
        // restore
        Route::put('suku/{id}/restore','restore')->name('adminmaster.masterdata.suku.restore');
    
        // delete
        Route::delete('suku/{id}/delete','delete')->name('adminmaster.masterdata.suku.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('suku/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.suku.forceDelete');

    });
