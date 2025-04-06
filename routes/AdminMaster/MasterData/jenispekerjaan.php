<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\JenisPekerjaanController;

    Route::controller(JenisPekerjaanController::class)->group(function(){

        // index
        Route::get('jenispekerjaan','index')->name('adminmaster.masterdata.jenispekerjaan');

        // create
        Route::get('jenispekerjaan/create','create')->name('adminmaster.masterdata.jenispekerjaan.create');
        // store
        Route::post('jenispekerjaan/store','store')->name('adminmaster.masterdata.jenispekerjaan.store');
        // show
        Route::get('jenispekerjaan/{id}/detail','show')->name('adminmaster.masterdata.jenispekerjaan.show');

        // edit
        Route::get('jenispekerjaan/{id}/edit','edit')->name('adminmaster.masterdata.jenispekerjaan.edit');

        // update
        Route::put('jenispekerjaan/{id}/update', 'update')->name('adminmaster.masterdata.jenispekerjaan.update');
    
        // destroy
        Route::delete('jenispekerjaan/{id}/destroy','destroy')->name('adminmaster.masterdata.jenispekerjaan.destroy');
    
        // trash
        Route::get('jenispekerjaan/trash','index')->name('adminmaster.masterdata.jenispekerjaan.trash');
    
        // restore
        Route::put('jenispekerjaan/{id}/restore','restore')->name('adminmaster.masterdata.jenispekerjaan.restore');
    
        // delete
        Route::delete('jenispekerjaan/{id}/delete','delete')->name('adminmaster.masterdata.jenispekerjaan.delete');
    
        // forceDelete | ForceDeletes > menghapus permanen dari database
        Route::delete('jenispekerjaan/{id}/ForceDelete','forceDelete')->name('adminmaster.masterdata.jenispekerjaan.forceDelete');

    });