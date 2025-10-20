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
        Schema::create('jenislembaga', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_lembaga_id')->unique();
            $table->string('nama', 150);
            $table->integer('tempat_pengawas')->nullable();
            $table->integer('simpul_pendataan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenislembaga');
    }
};
