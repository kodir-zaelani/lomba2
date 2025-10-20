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
        Schema::create('heroes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('teacher')->nulllable();
            $table->integer('student')->nulllable();
            $table->integer('administration')->nulllable();
            $table->string('ratio')->nulllable();
            $table->string('imagehero');
            $table->text('description');
            $table->string('link_hero')->nullable();
            $table->string('title_btn_link', 25)->nullable();
            $table->string('icon_link')->nullable();
            $table->string('target_link_hero', 25)->nullable();
            $table->string('video_hero')->nullable();
            $table->string('title_btn_video', 25)->nullable();
            $table->string('icon_btn_video', 50)->nullable();
            $table->string('target', 20)->default('_self');
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};