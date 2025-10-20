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
        Schema::create('statuskepemilikan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('sort_kepemilikan', 2, 0);
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('statuskepemilikan');
    }
};
