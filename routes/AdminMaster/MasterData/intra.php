<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterData\IntraController;

    Route::controller(IntraController::class)->group(function(){

        // index
        Route::get('intra','index')->name('adminmaster.masterdata.intra');
        
    });
