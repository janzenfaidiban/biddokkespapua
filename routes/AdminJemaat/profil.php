<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminJemaat\ProfilController;

    Route::controller(ProfilController::class)->group(function(){

        // index
        Route::get('profil','profil')->name('adminjemaat.profil');

        // print
        Route::get('print','print')->name('adminjemaat.print');

        // update
        Route::put('profil/{id}/update','update')->name('adminjemaat.profil.update');

         // delete images
        Route::delete('profil/{id}/delete-foto-gereja', 'deleteFotoGereja')->name('adminjemaat.profil.delete.fotoGereja');
        Route::delete('profil/{id}/delete-foto-pendeta', 'deleteFotoPendeta')->name('adminjemaat.profil.delete.fotoPendeta');

        // delete files
        Route::delete('profil/{id}/delete-struktur-organisasi', 'deleteFileStrukturOrganisasi')->name('adminjemaat.profil.delete.fileStrukturOrganisasi');
        Route::delete('profil/{id}/delete-sarana-prasarana', 'deleteFileSaranaPrasarana')->name('adminjemaat.profil.delete.fileSaranaPrasarana');

    });
