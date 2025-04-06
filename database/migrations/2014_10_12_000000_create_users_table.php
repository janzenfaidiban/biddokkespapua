<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            /*
            informasi hak akses di tingkat jemaat dan klasis
            */
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->text('alamat')->nullable();
            $table->longText('profil')->nullable();
            
            /*
            media sosial
            bisa digunakan untuk user di tingkat jemaat dan klasis
            */
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('wa_channel')->nullable();
            $table->string('youtube')->nullable();

            /*
            data tingkat klasis
            */
            $table->string('namaKetuaKlasis')->nullable();
            $table->string('fotoKantor')->nullable();
            $table->string('fotoKetuaKlasis')->nullable();

            /*
            data tingkat jemaat
            */
            $table->string('namaPendeta')->nullable();
            $table->string('fotoGereja')->nullable(); // file jpg, png
            $table->string('fotoPendeta')->nullable(); // file jpg, png
            
            /*
            data yang sama di tingkat jemaat dan klasis
            */
            $table->string('fileSaranaPrasarana')->nullable(); //file pdf
            $table->string('fileStrukturOrganisasi')->nullable(); // file pdf

            // pengaturan tema
            $table->string('theme')->default('light'); // file pdf

            $table->rememberToken();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
