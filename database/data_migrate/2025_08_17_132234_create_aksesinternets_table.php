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
        Schema::create('aksesinternet', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('akses_internet_id')->unique();
            $table->string('nama', 75);
            $table->string('media', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aksesinternet');
    }
};
