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
        Schema::create('watchlists', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('trader_id');
        $table->unsignedBigInteger('listing_id');
        $table->timestamps();
        
        $table->foreign('trader_id')->references('id')->on('traders')->onDelete('cascade');
        $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};