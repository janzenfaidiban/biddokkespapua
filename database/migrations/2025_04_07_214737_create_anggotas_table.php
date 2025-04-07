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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->unsignedBigInteger('program_studi_id')->nullable();
            $table->foreign('program_studi_id')->references('id')->on('program_studis')->onDelete('set null');
            
            $table->date('tanggal_pendaftaran');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->text('alamat_tinggal');
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->string('kampus');
            $table->string('fakultas');
            $table->string('program_studi');
            $table->string('foto')->nullable();
            $table->string('kpm')->nullable();
            $table->string('nim')->unique();
            $table->string('ktp')->nullable();
            $table->enum('status_anggota', ['aktif', 'nonaktif', 'pending'])->default('pending');
            $table->boolean('alumni')->default(false);
            $table->text('keterangan')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
