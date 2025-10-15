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
        Schema::table('extras', function (Blueprint $table) {
            $table->string('code')->after('id')->unique();
        });

        Schema::table('amenities', function (Blueprint $table) {
            $table->string('code')->after('id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->dropColumn('code');
        });

        Schema::table('amenities', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};
