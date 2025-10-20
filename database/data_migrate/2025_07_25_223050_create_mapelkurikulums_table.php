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
        Schema::create('mapelkurikulum', function (Blueprint $table) {
            $table->uuid('id');
			$table->integer('kurikulum_id');
            $table->integer('mata_pelajaran_id ', 32);
            $table->decimal('tingkat_pendidikan_id', 2, 0);
			$table->decimal('tingkat', 2, 0);
			$table->decimal('jumlah_jam', 2, 0);
            $table->decimal('jumlah_jam_maksimum',2, 0);
			$table->decimal('wajib',1, 0);
			$table->decimal('sks',2, 0);
			$table->decimal('a_peminatan',1, 0);
			$table->string('area_kompetensi', 1);
			$table->string('gmp_id', 36)->nullable();
			$table->timestamps();
            $table->softDeletes();
			$table->foreign('kurikulum_id')->references('kurikulum_id')->on('kurikulum')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('mata_pelajaran_id')->references('mata_pelajaran_id')->on('matapelajaran')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->primary(['id', 'mata_pelajaran_id', 'tingkat_pendidikan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapelkurikulum');
    }
};
