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
        Schema::create('statuspotonganspp', function (Blueprint $table) {
             $table->uuid('id')->primary();
            $table->foreignUuid('sekolah_id');
            $table->foreignUuid('tahunajaran_id');
            $table->string('nama')->unique();
            $table->unsignedInteger('persentase');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tahunajaran_id')->references('id')->on('tahunajaran')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuspotonganspp');
    }
};