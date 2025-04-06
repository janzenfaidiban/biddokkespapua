<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\GolonganDarahController;

    Route::controller(GolonganDarahController::class)->group(function(){

        // index
        Route::get('golongandarah','index')->name('adminmaster.masterdata.golongandarah');
        
    });
