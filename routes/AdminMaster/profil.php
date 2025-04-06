<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\ProfilController;

    Route::controller(ProfilController::class)->group(function(){
        
        // index
        Route::get('profil','profil')->name('adminmaster.profil');

        // update
        Route::put('profil/{id}/update','update')->name('adminmaster.profil.update');

    });
