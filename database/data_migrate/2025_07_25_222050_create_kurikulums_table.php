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
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('kurikulum_id');
            $table->string('nama_kurikulum', 120);
            $table->date('mulai_berlaku');
            $table->decimal('sistem_sks', 1, 0);
            $table->decimal('total_sks', 3, 0);
            $table->decimal('jenjang_pendidikan_id', 2, 0);
            $table->string('jurusan_id', 25)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('jurusan_id')->references('jurusan_id')->on('jurusan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('kurikulum');
    }
};
