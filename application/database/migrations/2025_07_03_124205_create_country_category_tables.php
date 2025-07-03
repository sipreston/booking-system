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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 256);
            $table->string('code', 8);
            $table->char('iso', 2);
            $table->string('nice_name', 256);
            $table->char('iso3', 3)->nullable();
            $table->integer('num_code')->nullable();
            $table->integer('phone_code');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('categories');
    }
};
