<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feed_data', function (Blueprint $table) {
            $table->integer('content_item_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('feed_data', function (Blueprint $table) {
            $table->dropColumn('content_item_id');
        });
    }
};
