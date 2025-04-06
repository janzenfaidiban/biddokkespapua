<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\HubunganKeluargaController;

    Route::controller(HubunganKeluargaController::class)->group(function(){

        // index
        Route::get('hubungankeluarga','index')->name('adminmaster.masterdata.hubungankeluarga');

        // create
        Route::get('hubungankeluarga/create','create')->name('adminmaster.masterdata.hubungankeluarga.create');
        // store
        Route::post('hubungankeluarga/store','store')->name('adminmaster.masterdata.hubungankeluarga.store');
        // show
        Route::get('hubungankeluarga/{id}/detail','show')->name('adminmaster.masterdata.hubungankeluarga.show');

        // edit
        Route::get('hubungankeluarga/{id}/edit','edit')->name('adminmaster.masterdata.hubungankeluarga.edit');

        // update
        Route::put('hubungankeluarga/{id}/update', 'update')->name('adminmaster.masterdata.hubungankeluarga.update');
    
        // destroy
        Route::delete('hubungankeluarga/{id}/destroy','destroy')->name('adminmaster.masterdata.hubungankeluarga.destroy');
    
        // trash
        Route::get('hubungankeluarga/trash','index')->name('adminmaster.masterdata.hubungankeluarga.trash');
    
        // restore
        Route::put('hubungankeluarga/{id}/restore','restore')->name('adminmaster.masterdata.hubungankeluarga.restore');
    
        // delete
        Route::delete('hubungankeluarga/{id}/delete','delete')->name('adminmaster.masterdata.hubungankeluarga.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('hubungankeluarga/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.hubungankeluarga.forceDelete');

    });