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
        Schema::create('tingkatpendidikan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('tingkat_pendidikan_id', 2, 0);
            $table->string('kode', 5);
            $table->string('nama', 20);
            $table->decimal('jenjang_pendidikan_id', 2, 0);
            $table->timestamps();
            $table->foreign('jenjang_pendidikan_id')->references('jenjang_pendidikan_id')->on('jenjangpendidikan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('tingkatpendidikan');
    }
};
