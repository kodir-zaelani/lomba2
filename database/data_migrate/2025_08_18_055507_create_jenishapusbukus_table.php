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
        Schema::create('jenishapusbuku', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_hapus_buku_id')->unique();
            $table->string('nama', 150);
            $table->integer('u_prasarana')->nullable();
            $table->integer('u_sarana')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenishapusbuku');
    }
};
