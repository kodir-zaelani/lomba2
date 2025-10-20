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
        Schema::create('matapelajaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('mata_pelajaran_id ', 32);
            $table->string('nama');
            $table->decimal('pilihan_sekolah', 1, 0);
            $table->decimal('pilihan_buku', 1, 0);
            $table->decimal('pilihan_kepengawasan', 1, 0);
            $table->decimal('pilihan_evaluasi', 1, 0);
            $table->string('jurusan_id', 25)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('jurusan_id')->references('jurusan_id')->on('jurusan')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('matapelajaran');
    }
};