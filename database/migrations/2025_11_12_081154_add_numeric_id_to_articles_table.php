<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->renameColumn('id', 'ulid');
            $table->id()->after('ulid');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->renameColumn('ulid', 'id');
        });
    }
};
