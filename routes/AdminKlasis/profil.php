<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminKlasis\ProfilController;

    Route::controller(ProfilController::class)->group(function(){

        // index
        Route::get('profil','profil')->name('adminklasis.profil');

        // print
        Route::get('print','print')->name('adminklasis.print');

        // update
        Route::put('profil/{id}/update','update')->name('adminklasis.profil.update');

         // Delete Images
        Route::delete('profil/{id}/delete-foto-kantor', 'deleteFotoKantor')->name('adminklasis.profil.delete.fotoKantor');
        Route::delete('profil/{id}/delete-foto-ketua-klasis', 'deleteFotoKetuaKlasis')->name('adminklasis.profil.delete.fotoKetuaKlasis');

        // delete files
        Route::delete('profil/{id}/delete-struktur-organisasi', 'deleteFileStrukturOrganisasi')->name('adminklasis.profil.delete.fileStrukturOrganisasi');
        Route::delete('profil/{id}/delete-sarana-prasarana', 'deleteFileSaranaPrasarana')->name('adminklasis.profil.delete.fileSaranaPrasarana');

    });
