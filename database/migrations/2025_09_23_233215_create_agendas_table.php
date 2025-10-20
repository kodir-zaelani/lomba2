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
        Schema::create('agendas', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('author_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('place')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('img')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('attach')->nullable();
            $table->text('description');
            $table->date('startdate');
            $table->date('enddate');
            $table->time('periode');
            $table->time('endperiode');
            $table->text('location')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('view_count')->default(0);
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
