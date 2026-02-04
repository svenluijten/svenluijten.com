<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->ulid()->unique();
            $table->string('title');
            $table->string('tour_name');
            $table->string('slug')->unique();
            $table->date('date');
            $table->text('content')->nullable();
            $table->foreignId('venue_id')->nullable()->constrained('venues');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
