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
        Schema::create('fotos', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('author_id');
            $table->uuid('album_id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('image');
            $table->boolean('status')->default(true);
            $table->integer('view_count')->default(0);
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('restrict');
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
