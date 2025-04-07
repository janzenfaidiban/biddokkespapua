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
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('kampus_id')->constrained('kampuses')->onDelete('cascade');
            
            $table->string('nama_fakultas');
            $table->text('keterangan')->nullable();
            
            $table->timestamps();
            $table->softDeletes(); // enable soft delete

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas');
    }
};
