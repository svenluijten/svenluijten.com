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
        Schema::create('records', function (Blueprint $table) {
            $table->id()->primary();
            $table->ulid()->unique();
            $table->string('title');
            $table->text('comment')->nullable();
            $table->string('discogs_release_code')->nullable();
            $table->timestamps();

            $table->index('ulid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
