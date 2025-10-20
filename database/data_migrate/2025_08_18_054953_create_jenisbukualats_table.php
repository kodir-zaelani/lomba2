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
        Schema::create('jenisbukualat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_buku_alat_id')->unique();
            $table->string('nama', 150);
            $table->integer('spm_qty_min_per_siswa')->nullable();
            $table->integer('spm_qty_min_per_sekolah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisbukualat');
    }
};