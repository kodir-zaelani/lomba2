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
        Schema::create('jeniskeluar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_keluar_id')->unique();
            $table->string('keterangan', 150);
            $table->integer('keluar_pd');
            $table->integer('keluar_ptk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jeniskeluar');
    }
};
