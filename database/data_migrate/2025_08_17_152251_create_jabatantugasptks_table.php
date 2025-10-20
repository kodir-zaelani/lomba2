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
        Schema::create('jabatantugasptk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jabatan_tugasptk_id')->unique();
            $table->string('nama', 150);
            $table->tinyInteger('jabatan_utama');
            $table->tinyInteger('tugas_tambahan_guru');
            $table->tinyInteger('jumlah_jam_diakui')->nullable();
            $table->tinyInteger('harus_refer_unit_org');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatantugasptk');
    }
};