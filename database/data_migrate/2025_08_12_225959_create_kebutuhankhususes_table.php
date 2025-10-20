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
        Schema::create('kebutuhankhusus', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('kebutuhan_khusus_id', 10)->unique();
            $table->string('kebutuhan_khusus', 50);
            $table->string('slug')->unique();
            $table->tinyInteger('kk_a');
            $table->tinyInteger('kk_b');
            $table->tinyInteger('kk_c');
            $table->tinyInteger('kk_c1');
            $table->tinyInteger('kk_d');
            $table->tinyInteger('kk_d1');
            $table->tinyInteger('kk_e');
            $table->tinyInteger('kk_f');
            $table->tinyInteger('kk_h');
            $table->tinyInteger('kk_i');
            $table->tinyInteger('kk_j');
            $table->tinyInteger('kk_k');
            $table->tinyInteger('kk_n');
            $table->tinyInteger('kk_o');
            $table->tinyInteger('kk_p');
            $table->tinyInteger('kk_q');
            $table->tinyInteger('untuk_lembaga');
            $table->tinyInteger('untuk_ptk');
            $table->tinyInteger('untuk_pd');
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhankhusus');
    }
};