<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artist_concert', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('artist_id')->constrained('artists');
            $table->foreignUlid('concert_id')->constrained('concerts');
            $table->string('position')->comment('Either "support" or "main"');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artist_concerts');
    }
};
