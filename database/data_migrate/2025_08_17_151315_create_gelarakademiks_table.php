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
        Schema::create('gelarakademik', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('gelara_kademik_id')->unique();
            $table->string('kode', 20);
            $table->string('nama', 150);
            $table->tinyInteger('posisi_gelar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gelarakademik');
    }
};
