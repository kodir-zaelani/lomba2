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
        Schema::create('bentukpendidikan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('bentuk_pendidikan_id', 2, 0);
            $table->string('nama', 50);
            $table->decimal('jenjang_paud', 1, 0);
            $table->decimal('jenjang_tk', 1, 0);
            $table->decimal('jenjang_sd', 1, 0);
            $table->decimal('jenjang_smp', 1, 0);
            $table->decimal('jenjang_sma', 1, 0);
            $table->decimal('jenjang_tinggi', 1, 0);
            $table->string('direktorat_pembinaan', 40);
            $table->decimal('aktif', 1, 0);
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('bentukpendidikan');
    }
};
