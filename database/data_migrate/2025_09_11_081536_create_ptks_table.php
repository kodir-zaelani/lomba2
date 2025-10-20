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
        Schema::create('ptk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sekolah_id')->nullable();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nik')->unique()->nullable();
            $table->string('niy_nigk')->unique()->nullable();
            $table->string('nuptk')->unique()->nullable();
            $table->foreignUuid('status_kepegawaian_id')->nullable();
            $table->foreignUuid('pengawas_bidang_studi_id')->nullable();
            $table->foreignUuid('jenisptk_id')->nullable();
            $table->foreignUuid('agama_id')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->string('rt', 5)->nullable()->default('00000');
            $table->string('rw', 5)->nullable()->default('00000');
            $table->string('nama_dusun')->nullable();
            $table->char('province_code', 2)->nullable();
            $table->char('city_code', 4)->nullable();
            $table->char('district_code', 7)->nullable();
            $table->char('village_code', 10)->nullable();
            $table->string('kode_pos', 5)->nullable();
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
            $table->text('maps')->nullable();
            $table->unsignedInteger('anak_keberapa')->default(1);
            $table->string('no_telepon_rumah')->nullable();
            $table->string('no_telepon_seluler')->nullable();
            $table->string('email')->nullable();
            $table->boolean('penerima_kps')->default(false);
            $table->string('no_kps')->nullable();
            $table->boolean('layak_pip')->default(false);
            $table->foreignUuid('alasanlayakpip_id')->nullable();
            $table->boolean('penerima_kip')->default(false);
            $table->string('no_kip')->nullable();
            $table->string('nama_kip')->nullable();
            $table->foreignUuid('statuspotonganspp_id')->nullable();
            $table->foreignUuid('jenistinggal_id')->nullable();
            $table->foreignUuid('alattransportasi_id')->nullable();
            $table->string('no_kks')->nullable();
            $table->string('reg_akta_lahir')->nullable();
            $table->foreignUuid('bank_id')->nullable();
            $table->string('rek_bank')->nullable();
            $table->string('nama_kcp')->nullable();
            $table->string('rek_atas_nama')->nullable();
            $table->unsignedInteger('status_data')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->char('tahun_lahir_ayah', 4)->nullable();
            $table->foreignUuid('jenjangpendidikan_ayah_id')->nullable();
            $table->foreignUuid('pekerjaan_ayah_id')->nullable();
            $table->foreignUuid('penghasilan_ayah_id')->nullable();
            $table->foreignUuid('kebutuhankhusus_ayah_id')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->char('tahun_lahir_ibu', 4)->nullable();
            $table->foreignUuid('jenjangpendidikan_ibu_id')->nullable();
            $table->foreignUuid('pekerjaan_ibu_id')->nullable();
            $table->foreignUuid('penghasilan_ibu_id')->nullable();
            $table->foreignUuid('kebutuhankhusus_ibu_id')->nullable();
            $table->string('nik_wali')->nullable();
            $table->char('tahun_lahir_wali', 4)->nullable();
            $table->foreignUuid('jenjangpendidikan_wali_id')->nullable();
            $table->foreignUuid('pekerjaan_wali_id')->nullable();
            $table->foreignUuid('penghasilan_wali_id')->nullable();
            $table->foreignUuid('kebutuhankhusus_wali_id')->nullable();
            $table->foreignUuid('negara_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bank_id')->references('id')->on('bank')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('alasanlayakpip_id')->references('id')->on('alasanlayakpip')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('alattransportasi_id')->references('id')->on('alattransportasi')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('jenistinggal_id')->references('id')->on('jenistinggal')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('statuspotonganspp_id')->references('id')->on('statuspotonganspp')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kebutuhankhusus_id')->references('id')->on('kebutuhankhusus')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('agama_id')->references('id')->on('agama')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->foreign('penghasilan_wali_id')->references('id')->on('penghasilanortu')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pekerjaan_wali_id')->references('id')->on('pekerjaan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('jenjangpendidikan_wali_id')->references('id')->on('jenjangpendidikan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kebutuhankhusus_wali_id')->references('id')->on('kebutuhankhusus')->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('penghasilan_ibu_id')->references('id')->on('penghasilanortu')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pekerjaan_ibu_id')->references('id')->on('pekerjaan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('jenjangpendidikan_ibu_id')->references('id')->on('jenjangpendidikan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kebutuhankhusus_ibu_id')->references('id')->on('kebutuhankhusus')->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('penghasilan_ayah_id')->references('id')->on('penghasilanortu')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pekerjaan_ayah_id')->references('id')->on('pekerjaan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('jenjangpendidikan_ayah_id')->references('id')->on('jenjangpendidikan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kebutuhankhusus_ayah_id')->references('id')->on('kebutuhankhusus')->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('negara_id')->references('id')->on('negara')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tahunajaran_id')->references('id')->on('tahunajaran')->onUpdate('CASCADE')->onDelete('CASCADE');

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
        Schema::dropIfExists('ptk');
    }
};
