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
        Schema::create('bidangstudi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('bidang_studi_id')->unique();
            $table->integer('kelompok_bidang_studi')->nullable();
            $table->string('kode', 30)->nullable();
            $table->string('nama', 150);
            $table->decimal('kelompok', 1, 0);
            $table->decimal('jenjang_paud', 1, 0);
            $table->decimal('jenjang_tk', 1, 0);
            $table->decimal('jenjang_sd', 1, 0);
            $table->decimal('jenjang_smp', 1, 0);
            $table->decimal('jenjang_sma', 1, 0);
            $table->decimal('jenjang_tinggi', 1, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidangstudi');
    }
};
