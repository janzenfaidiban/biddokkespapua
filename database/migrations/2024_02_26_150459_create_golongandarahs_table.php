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
        Schema::create('golongandarahs', function (Blueprint $table) {
            $table->id();
            
            $table->string('golongandarah');
            $table->mediumText('keterangan')->nullable();
            $table->boolean('default')->default(false); // data master default akan dibuat diseeder sebagai 'true'. Jika true maka tidak bisa edit/hapus

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golongandarahs');
    }
};
