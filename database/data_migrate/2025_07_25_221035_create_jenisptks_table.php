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
        Schema::create('jenisptk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('jenis_ptk_id', 4)->unique();
            $table->string('jenis_ptk');
            $table->smallInteger('guru_kelas');
            $table->smallInteger('guru_matpel');
            $table->smallInteger('guru_bk');
            $table->smallInteger('guru_inklusi');
            $table->smallInteger('pengawas_satdik');
            $table->smallInteger('pengawas_plb');
            $table->smallInteger('pengawas_matpel');
            $table->smallInteger('pengawas_bidang');
            $table->smallInteger('tas');
            $table->smallInteger('formal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('jenisptk');
    }
};
