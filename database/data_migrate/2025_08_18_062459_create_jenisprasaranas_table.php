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
        Schema::create('jenisprasarana', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_prasarana_id')->unique();
            $table->string('nama', 150);
            $table->integer('a_unit_organisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisprasarana');
    }
};
