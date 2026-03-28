<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_items', function (Blueprint $table) {
            $table->id();
            $table->ulid()->unique();
            $table->string('title');
            $table->string('slug');
            $table->text('content')->nullable();
            $table->morphs('contentable');
            $table->integer('feed_data_id')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->unique(['slug', 'contentable_type', 'contentable_id']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_items');
    }
};
