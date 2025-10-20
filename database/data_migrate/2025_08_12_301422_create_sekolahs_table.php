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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nss')->nullable()->unique();
            $table->string('npsn')->unique();
            $table->foreignUuid('yayasan_id')->nullable();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->foreignUuid('bentukpendidikan_id')->nullable();
            $table->foreignUuid('jenjangpendidikan_id')->nullable();
            $table->foreignUuid('statuskepemilikan_id')->nullable();
            $table->integer('type_sekolah')->nullable();
            $table->integer('status_sekolah')->nullable();
            $table->string('sk_pendirian_sekolah')->nullable();
            $table->date('tanggal_pendirian_sekolah')->nullable();
            $table->string('sk_izin_operasional')->nullable();
            $table->date('tanggal_izin_operasional')->nullable();
            $table->string('no_rekening')->nullable();
            $table->foreignUuid('bank_id')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('cabang_kcp_unit')->nullable();
            $table->boolean('mbs')->default(false);
            $table->string('npwp')->nullable();
            $table->string('nama_npwp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt', 5)->nullable()->default('00000');
            $table->string('rw', 5)->nullable()->       default('00000');
            $table->string('nama_dusun')->nullable();
            $table->char('province_code', 2)->nullable();
            $table->char('city_code', 4)->nullable();
            $table->char('district_code', 7)->nullable();
            $table->char('village_code', 10)->nullable();
            $table->foreignUuid('negara_id')->nullable();
            $table->string('kode_pos', 5)->nullable();
            $table->foreignUuid('kebutuhankhusus_id')->nullable();
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
            $table->text('maps')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('logo_sekolah')->nullable();
            $table->boolean('status_sekolah_update')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('bentukpendidikan_id')->references('id')->on('bentukpendidikan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('jenjangpendidikan_id')->references('id')->on('jenjangpendidikan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('statuskepemilikan_id')->references('id')->on('statuskepemilikan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('yayasan_id')->references('id')->on('yayasan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('negara_id')->references('id')->on('negara')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('bank_id')->references('id')->on('bank')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kebutuhankhusus_id')->references('id')->on('kebutuhankhusus')->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('province_code')
            ->references('code')
            ->on(config('laravolt.indonesia.table_prefix').'provinces')
            ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('city_code')
            ->references('code')
            ->on(config('laravolt.indonesia.table_prefix').'cities')
            ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('district_code')
            ->references('code')
            ->on(config('laravolt.indonesia.table_prefix').'districts')
            ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('village_code')
            ->references('code')
            ->on(config('laravolt.indonesia.table_prefix').'villages')
            ->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};
