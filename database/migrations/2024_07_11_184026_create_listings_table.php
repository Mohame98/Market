<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Trader;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trader::class)->constrained()->onDelete('cascade');
            $table->string('listing_img');
            $table->string('title', 199);
            $table->decimal('price', 10, 2);
            $table->text('description', 400);
            $table->string('location', 199);
            $table->timestamps();

            // Optional: Indexes for better performance on frequently queried fields
            // $table->index('title'); Index on title if it is frequently searched
            // $table->index('location'); Index on location if it is frequently searched
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
