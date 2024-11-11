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
        Schema::create('top_advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('top_ad');
            $table->string('top_ad_url')->nullable();
            $table->string('top_ad_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_advertisements');
    }
};
