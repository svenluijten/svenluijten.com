<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feed_data', function (Blueprint $table) {
            $table->id();
            $table->morphs('feedable');
            $table->string('identifier');
            $table->timestamps();

            $table->unique(['feedable_id', 'feedable_type', 'identifier']);
        });
    }
};
