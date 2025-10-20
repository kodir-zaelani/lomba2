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
        Schema::create('jenissarana', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_sarana_id')->unique();
            $table->string('nama', 150);
            $table->string('kelompok', 150)->nullable();
            $table->integer('perlu_penempatan')->nullable();
            $table->string('keterangan', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenissarana');
    }
};
