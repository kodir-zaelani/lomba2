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
        Schema::create('jenisbantuan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_bantuan_id')->unique();
            $table->string('nama', 150);
            $table->integer('untuk_sekolah')->nullable();
            $table->integer('untuk_pd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisbantuan');
    }
};