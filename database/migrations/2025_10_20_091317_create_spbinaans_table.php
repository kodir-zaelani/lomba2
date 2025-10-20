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
        Schema::create('spbinaans', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('sekolah_id');
            $table->foreignUuid('jenjangpendidikan_id');
            $table->foreignUuid('dukungan_id');
            $table->string('strategi');
            $table->string('lingkup_pembahasan');
            $table->text('program_kerja')->nullable();
            $table->text('kelebihan')->nullable();
            $table->text('kondisi_real')->nullable();
            $table->text('umpan_balik')->nullable();
            $table->text('perubahan')->nullable();
            $table->text('rencana_perbaikan')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
            $table->foreign('dukungan_id')->references('id')->on('dukungans')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('jenjangpendidikan_id')->references('id')->on('jenjangpendidikan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spbinaans');
    }
};
