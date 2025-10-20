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
        Schema::create('semester', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('semesterid', 5);
            $table->foreignUuid('tahunajaran_id')->nullable();
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->string('nama');
            $table->decimal('semester', 1, 0);
            $table->decimal('periode_aktif', 1, 0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
            $table->foreign('tahun_ajaran_id')->references('tahun_ajaran_id')->on('tahunajaran')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tahunajaran_id')->references('id')->on('tahunajaran')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('semester');
    }
};
