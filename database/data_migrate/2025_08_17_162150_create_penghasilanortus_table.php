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
        Schema::create('penghasilanortu', function (Blueprint $table) {
             $table->uuid('id')->primary();
            $table->integer('penghasilan_ortu_id')->unique();
            $table->string('nama', 150);
            $table->bigInteger('batas_bawah');
            $table->bigInteger('batas_atas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghasilanortu');
    }
};