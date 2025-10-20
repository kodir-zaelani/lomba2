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
        Schema::create('jenjangpendidikan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('jenjang_pendidikan_id', 2, 0);
            $table->string('nama', 25);
            $table->decimal('jenjang_lembaga', 1, 0);
            $table->decimal('jenjang_orang', 1, 0);
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('jenjangpendidikan');
    }
};
