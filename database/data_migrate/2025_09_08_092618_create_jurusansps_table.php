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
        Schema::create('jurusansp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sekolah_id');
            $table->foreignUuid('kebutuhankhusus_id');
            $table->foreignUuid('jurusan_id');
            $table->string('nama');
            $table->string('sk_izin')->nullable();
            $table->date('tanggal_sk_izin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('kebutuhankhusus_id')->references('id')->on('kebutuhankhusus')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('jurusansp');
    }
};
