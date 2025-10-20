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
        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ekstrakurikuler_id')->unique();
            $table->string('nama', 150);
            $table->decimal('u_sd', 1, 0);
            $table->decimal('u_smp', 1, 0);
            $table->decimal('u_sma', 1, 0);
            $table->decimal('u_smk', 1, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikuler');
    }
};
