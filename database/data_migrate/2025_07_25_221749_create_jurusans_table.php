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
        Schema::create('jurusan', function (Blueprint $table) {
            $table->uuid('id')->primary('id');
            $table->string('jurusan_id', 25)->unique();
            $table->string('nama_jurusan', 100);
            $table->decimal('untuk_sma', 1, 0);
            $table->decimal('untuk_smk', 1, 0);
            $table->decimal('untuk_pt', 1, 0);
            $table->decimal('untuk_slb', 1, 0);
            $table->decimal('untuk_smklb', 1, 0);
            $table->decimal('jenjangpendidikan_id', 1, 0)->nullable();
            $table->string('jurusan_induk', 25)->nullable();
            $table->string('level_bidang_id', 5);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('jurusan_induk')->references('jurusan_id')->on('jurusan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};
