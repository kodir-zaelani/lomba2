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
        Schema::create('jenisbeasiswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('jenis_beasiswa_id')->unique();
            $table->integer('sumber_dana_id')->nullable();
            $table->string('nama', 150);
            $table->integer('untuk_pd')->nullable();
            $table->integer('untuk_ptk')->nullable();
            $table->timestamps();

            $table->foreign('sumber_dana_id')->references('sumber_dana_id')->on('sumberdana')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisbeasiswa');
    }
};
