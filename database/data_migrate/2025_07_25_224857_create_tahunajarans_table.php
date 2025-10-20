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
        Schema::create('tahunajaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->string('nama', 10);
			$table->decimal('periode_aktif', 1, 0);
			$table->date('tanggal_mulai');
			$table->date('tanggal_selesai');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahunajaran');
    }
};